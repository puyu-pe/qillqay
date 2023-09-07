<?php
namespace PuyuPe\NexusPdf;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use PuyuPe\NexusPdf\Extension\RuntimeLoader;
use PuyuPe\NexusPdf\Extension\ReportTwigExtension;

use  mikehaertl\wkhtmlto\Pdf;

class PdfGenerator
{
    public static function generatePdf($data, $wkhtmlPath)
    {
        $templatePath = __DIR__;

        $loader = new FilesystemLoader($templatePath);
        $twig = new Environment($loader);

        $twig->addRuntimeLoader(new RuntimeLoader());
        $twig->addExtension(new ReportTwigExtension());

        $reportType = 'invoice';
        if($data->tipoDoc == '09') {
            $reportType = 'despatch';
            $tipoDoc = $data->destinatario->tipoDoc;
            $numDoc = $data->destinatario->numDoc;
        }else{
            $tipoDoc = $data->client->tipoDoc;
            $numDoc = $data->client->numDoc;
        }

        $stringQr = implode("|", [
            $data->company->ruc,
            $data->tipoDoc,
            $data->serie,
            str_pad($data->correlativo, 6, "0", STR_PAD_LEFT),
            $data->mtoIGV ?? 0 ,
            $data->mtoImpVenta ?? 0,
            date("d/m/Y", strtotime($data->fechaEmision)),
            $tipoDoc,
            $numDoc,
            $data->params['system']->hash?? $data->params->system->hash
        ]);
        $data->stringQr = $stringQr;

        $html = $twig->render("templates/$reportType.html.twig", ['doc' => $data]);


        $pdf = new Pdf([
            'binary' => $wkhtmlPath,
        ]);

        $pdf->addPage($html);
        $pdf->send();
    }
}
