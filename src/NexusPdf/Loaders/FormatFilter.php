<?php

declare(strict_types=1);

namespace PuyuPe\NexusPdf\Loaders;

/**
 * Class FormatFilter
 */
class FormatFilter
{
    public function number($number, $decimals = 2): ?string
    {
        if ($number == null) {
            return "0.00";
        } else {

            if(is_numeric($number)){
                $number = doubleval($number);
            }

            return number_format($number, $decimals, '.', '');
        }
    }
}
