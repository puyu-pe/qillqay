<?php

namespace PuyuPe\NexusPdf\Loaders;

use BaconQrCode\Common\ErrorCorrectionLevel;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

/**
 * Class QrRender.
 */
class QrRender
{
    public function getQrImage(string $content)
    {
        $renderer = new ImageRenderer(
            new RendererStyle(120, 0),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        return $writer->writeString($content, 'UTF-8', ErrorCorrectionLevel::Q());
    }
}
