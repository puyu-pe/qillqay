<?php

namespace PuyuPe\Qillqay;

use PuyuPe\Qillqay\Extension\ReportTwigExtension;
use PuyuPe\Qillqay\Extension\RuntimeLoader;
use mikehaertl\wkhtmlto\Pdf;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Generate
{
    public static function fromObject($data, $format = 'pdf', $wkhtmlPath = 'wkhtmltopdf', $env = 'run')
    {
        try {
            $templatePath = __DIR__;

            $loader = new FilesystemLoader($templatePath);
            $twig = new Environment($loader);

            $twig->addRuntimeLoader(new RuntimeLoader());
            $twig->addExtension(new ReportTwigExtension());

            $reportType = 'invoice';

            if ($data->tipoDoc == '09') {
                $reportType = 'despatch';
            } else {
                if (isset($data->formato) && $data->formato == 'ticket') {
                    $reportType = 'ticket';
                }
            }

            foreach($data->details as $item){
                $item->descripcion = str_replace('&nbsp;', ' ', $item->descripcion);
            }

            $html = $twig->render("templates/$reportType.html.twig", ['doc' => $data]);

            $size = $data->formato ?? null;

            return self::runGeneration($html, $data, $wkhtmlPath, $format, $size, $env);

        } catch (Exception $exs) {
            return $exs->getTraceAsString();
        }
    }

    public static function fromHtml($html, $format = 'pdf', $size = 'a4', $wkhtmlPath = 'wkhtmltopdf', $env = 'run')
    {
        try {
            return self::runGeneration($html, null, $wkhtmlPath, $format, $size,  $env);

        } catch (Exception $exs) {
            return $exs->getTraceAsString();
        }
    }

    public static function runGeneration($html, $data, $wkhtmlPath, $format = 'pdf', $size = 'a4', $env = 'run')
    {
        switch ($format) {
            case "file":
            case "pdf":

                $options = self::getOptions($size, $data);
                $options['binary'] = $wkhtmlPath;
                $pdf = new Pdf($options);

                $pdf->addPage($html);

                if ($env == 'test' || $format == 'file') {
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

                break;
            case "html":
                if ($env == 'test') {
                    $resultPath = sys_get_temp_dir() . '/nexuspdf_' . self::generateRandomString(6) . '.html';
                    file_put_contents($resultPath, $html);
                    return $resultPath;
                }

                return $html;

            default:
                return 'Formato no reconocido';
        }
    }


    private static function generateRandomString($length = 6)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }

    private static function getOptions($size, $data = null)
    {
        switch ($size) {
            case 'ticket':

                $height = '210mm';
                if ($data != null) {
                    $height = self::estimateTicketHeight($data) . 'mm';
                }

                return [
                    'no-outline',
                    'print-media-type',
                    'page-width' => '80mm',
                    'page-height' => $height,
                    'margin-top' => '5mm',
                    'margin-bottom' => '5mm',
                    'margin-left' => '3mm',
                    'margin-right' => '3mm',
                ];
            default:
                return [
                    'no-outline',
                    'print-media-type'
                ];
        }
    }

    private static function estimateTicketHeight($data)
    {
        $baseHeight = 220;
        $additionalHeight = 0;

        if (isset($data->params->user->header)) {
            $additionalHeight += 20;
        }

        if ($data->tipoDoc == '07') {
            $additionalHeight += 30;
        }

        if (isset($data->details) && is_array($data->details)) {
            $itemHeight = 6;
            $additionalHeight = count($data->details) * $itemHeight;
        }

        $totalHeight = $baseHeight + $additionalHeight;

        return $totalHeight;
    }
}
