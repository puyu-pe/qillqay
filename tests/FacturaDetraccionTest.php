<?php

namespace PuyuPe\NexusPdf\Tests;

use PuyuPe\NexusPdf\PdfGenerator;

use PHPUnit\Framework\TestCase;

class FacturaDetraccionTest extends TestCase
{
    private $config;

    protected function setUp(): void
    {
        parent::setUp();
        $this->config = parse_ini_file(__DIR__ . '/config.ini');
    }

    public function testGeneratePdf()
    {
        $data = $this->getMockedData();
        $wkhtmlPath = $this->config['wkhtmlPath'];
        $format = $this->config['format'];
        $filePath = PdfGenerator::generatePdf($data, $wkhtmlPath, $format, 'test');

        $this->assertFileExists($filePath);
    }

    public function getMockedData()
    {
        $data = $this->getData();
        $data->params = $this->getParams();
        $data->params->user->logo = $this->config['logo'];
        return $data;
    }

    private function getData()
    {
        $cpeJSON = '{
          "company": {
            "ruc": "20161515648",
            "razonSocial": "Corporaci\u00F3n DEVELOPMENT",
            "nombreComercial": "Corporaci\u00F3n DEVELOPMENT",
            "address": {
              "ubigueo": "030101",
              "codigoPais": "PE",
              "departamento": "Apur\u00EDmac",
              "provincia": "Abancay",
              "distrito": "Abancay",
              "urbanizacion": null,
              "direccion": "av. villa el sol",
              "codLocal": "0000"
            },
            "email": null,
            "telephone": null
          },
          "tipoOperacion": "1001",
          "formato": "a4",
          "tipoDoc": "01",
          "codLocal": "0000",
          "serie": "F001",
          "correlativo": "53",
          "fechaEmision": "2023-09-21 17:39:05",
          "fechaVencimiento": "2023-09-21",
          "tipoMoneda": "PEN",
          "mtoOperGravadas": "720.3390",
          "mtoOperExoneradas": "0.0000",
          "mtoOperInafectas": "0.0000",
          "mtoIGV": "129.6610",
          "totalImpuestos": "129.6610",
          "valorVenta": "720.3390",
          "subTotal": "850.0000",
          "mtoImpVenta": "850.0000",
          "formaPago": {
            "moneda": "PEN",
            "tipo": "Contado",
            "monto": "850.000000"
          },
          "cuotas": [],
          "client": {
            "tipoDoc": "6",
            "numDoc": "20564379248",
            "rznSocial": "FASTWORKX S.R.L.",
            "address": {
              "ubigueo": "-",
              "direccion": "AV. VILLA EL SOL MZA. E LOTE. 8 URB. BELLAVISTA BAJA"
            },
            "email": null,
            "telephone": null
          },
          "cashier": {
            "tipoDoc": 1,
            "numDoc": "-",
            "rznSocial": "root"
          },
          "details": [
            {
              "codProducto": "-",
              "unidad": "NIU",
              "descripcion": "VINO DE MISA GENEROSO",
              "cantidad": "1.0000",
              "mtoValorUnitario": "720.3390",
              "mtoValorVenta": "720.3390",
              "mtoBaseIgv": "720.3390",
              "porcentajeIgv": "18",
              "igv": "129.6610",
              "tipAfeIgv": "10",
              "totalImpuestos": "129.6610",
              "mtoPrecioUnitario": "850.0000"
            }
          ],
          "legends": [
            {
              "code": "1000",
              "value": "OCHOCIENTOS CINCUENTA  CON 00/100 SOLES."
            },
            {
              "code": "2006",
              "value": "Operaci\u00F3n sujeta al Sistema de Pago de Obligaciones Tributarias con el Gobierno Central."
            }
          ],
          "observation": "test observación",
          "documentFooter": null,
          "detraccion": {
            "valueRef": null,
            "codBienDetraccion": "020",
            "codMedioPago": "001",
            "ctaBanco": "334 4563 45678 4563",
            "percent": "4",
            "mount": "34.0000"
          }
        }';

        return json_decode($cpeJSON);
    }

    private function getParams()
    {
        $params = '{
                "system": {
            "hash": "m70vBMajaapHr5ByjkwEER8tCjc=",
            "background": "#123456",
            "anulled": false,
            "is_production": true
          },
          "user": {
                    "footer": "MUCHAS GRACIAS POR SU PREFERENCIA</br></br><div>Consulte el documento electrónico en :</br>http://localhost:8080/10123456789</div><br>",
            "header": null,
            "extras": [
              {
                "name": "FORMA DE PAGO",
                "value": "Contado PEN 36.00"
              },
              {
                "name": "CAJERO",
                "value": "delfina"
              },
              {
                "name": "OBSERVACIÓN",
                "value": ""
              }
            ],
            "logo": ""
          },
          "documentFooter": null
        }';
        return json_decode($params);
    }
}
