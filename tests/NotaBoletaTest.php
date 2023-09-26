<?php

namespace PuyuPe\NexusPdf\Tests;

use PuyuPe\NexusPdf\PdfGenerator;

use PHPUnit\Framework\TestCase;

class NotaBoletaTest extends TestCase
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
            "ruc": "10123456789",
            "razonSocial": "EMPRESA TEST",
            "nombreComercial": "EMPRESA TEST S.R.L.",
            "address": {
              "ubigueo": "030101",
              "codigoPais": "PE",
              "departamento": "Apurímac",
              "provincia": "Abancay",
              "distrito": "Abancay",
              "urbanizacion": null,
              "direccion": "AV. BRILLA EL SOL MZ. X Lt. 46 - URB. BELLA VISTA BAJA - ABANCAY - APURIMAC",
              "codLocal": "0000"
            },
            "email": null,
            "telephone": null
          },
          "totalImpuesto": "17.53",
            "mtoIGV": "17.53",
            "valorVenta": "97.39",
            "formato": "a4",
            "mtoOperGratuitas": "0.00",
            "mtoISC": "0.00",
            "correlativo": 65,
            "fechaEmision": "2023-08-31",
            "mtoIGVGratuitas": "0.00",
            "tipoMoneda": "PEN",
            "mtoOperGravadas": "97.39",
            "mtoImpVenta": "114.92",
            "legends": [
            {
            "code": "1000",
            "value": "CIENTO CATORCE  CON 92/100 SOLES"
            }
            ],
            "mtoOperExoneradas": "0.00",
            "serie": "BN01",
            "tipoDoc": "07",
            "client": {
            "rznSocial": "HERLINDA FARFAN DE LA CRUZ",
            "address": {
            "distrito": "-",
            "direccion": "MCDO. EL PINO PTO 64 ABARROTES",
            "ubigueo": "140101",
            "departamento": "-",
            "provincia": "-",
            "codigoPais": "PE"
            },
            "tipoDoc": "1",
            "numDoc": "44828861"
            },
            "details": [
            {
            "descripcion": "AMMENS SH.MANZ+1TAL+SH400ML.12FRASC",
            "porcentajeIgv": "18.00",
            "mtoValorVenta": "42.34",
            "totalImpuesto": "7.62",
            "mtoValorGratuito": 0,
            "unidad": "NIU",
            "mtoPrecioUnitario": "24.9800",
            "mtoBaseIgv": "42.34",
            "codProducto": "418744",
            "mtoValorUnitario": "21.1695",
            "igv": "7.62",
            "cantidad": "2.00",
            "tipAfeIgv": "10"
            },
            {
            "descripcion": "AMMENS SH.ORIG+1TAL+SH400ML.12FRASC",
            "porcentajeIgv": "18.00",
            "mtoValorVenta": "42.34",
            "totalImpuesto": "7.62",
            "mtoValorGratuito": 0,
            "unidad": "NIU",
            "mtoPrecioUnitario": "24.9800",
            "mtoBaseIgv": "42.34",
            "codProducto": "418745",
            "mtoValorUnitario": "21.1695",
            "igv": "7.62",
            "cantidad": "2.00",
            "tipAfeIgv": "10"
            },
            {
            "descripcion": "CREMA HABAS QUILLAB.X180GRX12UND",
            "porcentajeIgv": "18.00",
            "mtoValorVenta": "6.36",
            "totalImpuesto": "1.14",
            "mtoValorGratuito": 0,
            "unidad": "NIU",
            "mtoPrecioUnitario": "2.4999",
            "mtoBaseIgv": "6.36",
            "codProducto": "416652",
            "mtoValorUnitario": "2.1186",
            "igv": "1.14",
            "cantidad": "3.00",
            "tipAfeIgv": "10"
            },
            {
            "descripcion": "CREMA AVERJ.QUILLAB.X180GRX12UND",
            "porcentajeIgv": "18.00",
            "mtoValorVenta": "6.36",
            "totalImpuesto": "1.14",
            "mtoValorGratuito": 0,
            "unidad": "NIU",
            "mtoPrecioUnitario": "2.4999",
            "mtoBaseIgv": "6.36",
            "codProducto": "366952",
            "mtoValorUnitario": "2.1186",
            "igv": "1.14",
            "cantidad": "3.00",
            "tipAfeIgv": "10"
            }
            ],
            "codLocal": "0000",
            "mtoOperInafectas": "0.00",
            "summary_id": 86697,
            "tipDocAfectado": "03",
            "numDocfectado": "B001-44403",
            "codMotivo": "01",
            "desMotivo": "ANULACION DE LA OPERACIÓN"
            }';

        return json_decode($cpeJSON);
    }

    private function getParams()
    {
        $params = '{
                "system": {
            "hash": "m70vBMajaapHr5ByjkwEER8tCjc=",
            "background": "#000000",
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
