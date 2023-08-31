<?php

require 'vendor/autoload.php';

use Mikehaertl\wkhtmlto\Pdf;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class PdfDocument
{
    protected $pdf;
    protected $twig;

    public function __construct()
    {
        $this->pdf = new Pdf();
        $loader = new FilesystemLoader(__DIR__ . '/../templates');
        $this->twig = new Environment($loader);
    }

    public function generatePdfFromJson($templateFile, $json)
    {
        $html = $this->renderTwigTemplate($templateFile, json_decode($json, true));
        $this->pdf->addPage($html);
        $pdfOutput = $this->pdf->toString();
        return $pdfOutput;
    }

    protected function renderTwigTemplate($templateFile, $data)
    {
        $template = $this->twig->load($templateFile);
        return $template->render($data);
    }
}
