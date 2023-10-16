<?php

declare(strict_types=1);

namespace PuyuPe\Qillqay\Loaders;

/**
 * Class DocumentFilter.
 */
class DocumentFilter
{
    /* LISTA DE CATALOGOS:

https://cpe.sunat.gob.pe/sites/default/files/inline-files/anexoV-340-2017.pdf
Anexo N.° 8 - Catálogo de códigos

Catálogo No. 01: Código de tipo de documento
Catálogo No. 02: Códigos de tipo de monedas
Catálogo No. 021: Símbolos de códigos de tipo de monedas
Catálogo No. 03: Códigos de tipo de unidad de medida comercial
Catálogo No. 04: Códigos de Países
Catálogo No. 06: Códigos de tipos de documentos de identidad
Catálogo No. 061: Símbolos de tipos de documentos de identidad
Catálogo No. 07: Códigos de tipo de afectación del IGV
Catálogo No. 08: Códigos de tipos de sistema de cálculo del ISC
Catálogo No. 09: Códigos de tipo de nota de crédito electrónica
Catálogo No. 10: Códigos de Tipo de nota de débito electrónica
Catálogo No. 11: Resumen diario de boletas de venta y notas electrónicas - Código de tipo de valor de venta
Catálogo No. 12: Códigos - Documentos relacionados tributarios
Catálogo No. 13: Ubicación geográfica (UBIGEO)
Catálogo No. 14: Códigos - Otros conceptos tributarios
Catálogo No. 15: Códigos - Elementos adicionales en la Factura Electrónica y/o Boleta de Venta Electrónica
Catálogo No. 16: Códigos – Tipo de precio de venta unitario
Catálogo No. 17: Códigos – Tipo de operación
Catálogo No. 18: Códigos – Modalidad de traslado
Catálogo No. 19: Resumen Diario de boletas de venta y notas electrónicas - Códigos de estado de ítem
Catálogo No. 20: Códigos – Motivos de traslado
Catálogo No. 21: Documentos relacionados - aplicable solo para la Guía de remisión electrónica
Catálogo No. 22: Regímenes de Percepción
Catálogo No. 23: Regímenes de Retención
Catálogo No. 24: Recibo electrónico por servicios públicos
Catálogo No. 25: Código producto SUNAT
Catálogo No. 26: Tipo de préstamo
Catálogo No. 27: Indicador de primera vivienda
Catálogo No. 51: Código de tipo de factura
Catálogo No. 52: Código de leyendas
Catálogo No. 53: Códigos de cargos o descuentos
Catálogo No. 54: Códigos de bienes y servicios sujetos a detracción
Catálogo No. 55: Código de identificación del ítem
Catálogo No. 56: Código de tipo de servicio público
Catálogo No. 57: Código de tipo de servicios públicos - telecomunicaciones
Catálogo No. 58: Código de tipo de medidor – recibo de l
Catálogo No. 59: Medios de pago

     */

    /**
     * @var string
     */
    public function getValueCatalog($value, $code): ?string
    {
        $catalogDirectory = __DIR__ . '/../catalog';
        $catalogFilePath = $catalogDirectory . "/cat_{$code}.xml";

        if (!file_exists($catalogFilePath)) {
            return '';
        }

        $xml = simplexml_load_file($catalogFilePath);
        $items = [];

        foreach ($xml->c as $item) {
            $items[(string)$item['id']] = (string)$item;
        }

        return isset($items[$value]) ? strtoupper($items[$value]) : '';
    }
}
