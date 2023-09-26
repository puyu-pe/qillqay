<?php

namespace PuyuPe\NexusPdf\Tests;

use PuyuPe\NexusPdf\PdfGenerator;

use PHPUnit\Framework\TestCase;

class GuiaRemisionTest extends TestCase
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
            "ruc": "20602974503",
            "razonSocial": "GARY MOTORS DMG S.R.L.",
            "nombreComercial": "GARY MOTORS DMG S.R.L.",
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
            "tipoDoc": "09",
            "serie": "T001",
            "correlativo": "38",
            "fechaEmision": "2023-08-22",
            "observation": "ORDEN DE COMPRA Nº 2310297\n- Generado desde: PROFORMA 001-13285 el 22/08/2023\n__________________________________________________\n*NO SE ACEPTARÁN DEVOLUCIONES PARA PRODUCTOS DE SISTEMA ELÉCTRICO\n- Generado desde : FACTURA ELÉCTRONICA F001-4798 del 21/08/2023",
            "destinatario": {
            "tipoDoc": "6",
            "numDoc": "20115425651",
            "rznSocial": "EPS EMUSAP ABANCAY S.A."
            },
            "envio": {
            "modTraslado": "01",
            "codTraslado": "01",
            "desTraslado": "VENTA",
            "fecTraslado": "2023-08-22",
            "indTransbordo": 0,
            "pesoTotal": "0.20",
            "undPesoTotal": "KGM",
            "transportista": {
            "tipoDoc": "6",
            "numDoc": "20602974503",
            "rznSocial": "GARY MOTORS DMG S.R.L.",
            "nroMtc": "0001"
            },
            "partida": {
            "ubigeo": "030101",
            "direccion": "AV:PANAMERICANA 1319 ABANCAY-ABANCAY-APURIMAC"
            },
            "llegada": {
            "ubigeo": "030101",
            "direccion": "AV. PRADO NORTE N° 404"
            }
            },
            "details": [
            {
            "codigo": "5973",
            "descripcion": "GUANTES CITY IMPERMEABLE  L COLORES RB",
            "unidad": "NIU",
            "cantidad": "2.00"
            }
            ]
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
            "extras": [ ],
            "logo": ""
          },
          "documentFooter": null
        }';
        return json_decode($params);
    }
}
