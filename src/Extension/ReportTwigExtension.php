<?php

namespace PuyuPe\Qillqay\Extension;

use PuyuPe\Qillqay\Loaders\DocumentFilter;
use PuyuPe\Qillqay\Loaders\FormatFilter;
use PuyuPe\Qillqay\Loaders\ImageFilter;
use PuyuPe\Qillqay\Loaders\LegendFilter;
use PuyuPe\Qillqay\Loaders\QrRender;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

/**
 * Class ReportTwigExtension.
 */
class ReportTwigExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('catalog', [DocumentFilter::class, 'getValueCatalog']),
            new TwigFilter('image_b64', [ImageFilter::class, 'toBase64']),
            new TwigFilter('n_format', [FormatFilter::class, 'number']),
        ];
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('legend', [LegendFilter::class, 'getValueLegend']),
            new TwigFunction('qrCode', [QrRender::class, 'getQrImage']),
        ];
    }
}
