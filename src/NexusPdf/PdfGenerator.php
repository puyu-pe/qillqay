<?php

namespace PuyuPe\NexusPdf;

use PuyuPe\NexusPdf\Extension\ReportTwigExtension;
use PuyuPe\NexusPdf\Extension\RuntimeLoader;
use mikehaertl\wkhtmlto\Pdf;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class PdfGenerator
{
    public static function generatePdf($data, $wkhtmlPath, $env = 'run')
    {
        $templatePath = __DIR__;

        $loader = new FilesystemLoader($templatePath);
        $twig = new Environment($loader);

        $twig->addRuntimeLoader(new RuntimeLoader());
        $twig->addExtension(new ReportTwigExtension());

        $reportType = 'invoice';
        if ($data->tipoDoc == '09') {
            $reportType = 'despatch';
            $tipoDoc = $data->destinatario->tipoDoc;
            $numDoc = $data->destinatario->numDoc;
        } else {
            $tipoDoc = $data->client->tipoDoc;
            $numDoc = $data->client->numDoc;
        }

        $stringQr = implode("|", [
            $data->company->ruc,
            $data->tipoDoc,
            $data->serie,
            str_pad($data->correlativo, 6, "0", STR_PAD_LEFT),
            $data->mtoIGV ?? 0,
            $data->mtoImpVenta ?? 0,
            date("d/m/Y", strtotime($data->fechaEmision)),
            $tipoDoc,
            $numDoc,
            $data->params->system->hash ?? $data->params['system']->hash
        ]);
        $data->stringQr = $stringQr;

        $html = $twig->render("templates/$reportType.html.twig", ['doc' => $data]);

        $pdf = new Pdf([
            'binary' => $wkhtmlPath,
        ]);

        $pdf->addPage($html);

        if ($env == 'test') {
            $tempFilePath = sys_get_temp_dir() . '/nexuspdf_' . self::generateRandomString(6) . '.pdf';
            $result = $pdf->saveAs($tempFilePath);

            if (!$result) {
                $error = $pdf->getError();
                $resultPath = '/tmp/test-result.txt';
                file_put_contents($resultPath, $error);
            }

            return $tempFilePath;
        } else {
            $pdf->send();
        }

    }

    public function generateRandomString($length = 6)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }
}
