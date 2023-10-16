<?php

declare(strict_types=1);

namespace PuyuPe\Qillqay\Loaders;

/**
 * Class LegendFilter.
 */
class LegendFilter
{
    /**
     * @param (object)[] $legends
     * @param string $code
     *
     * @return string
     */
    public function getValueLegend($legends, $code): ?string
    {
        foreach ($legends as $legend) {
            if ($legend->code == $code) {
                return $legend->value;
            }
        }

        return '';
    }
}
