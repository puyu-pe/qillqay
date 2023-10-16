<?php

namespace PuyuPe\Qillqay\Tests;

use PuyuPe\Qillqay\Generate;

use PHPUnit\Framework\TestCase;

class NotaFacturaTest extends TestCase
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
        $filePath = Generate::fromObject($data, $format, $wkhtmlPath, 'test');

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
            "totalImpuesto": "10.96",
            "mtoIGV": "10.96",
            "valorVenta": "60.86",
            "formato": "a4",
            "mtoISC": "0.00",
            "codMotivo": "07",
            "correlativo": "186",
            "fechaEmision": "2023-09-05T13:57:50-05:00",
            "mtoIGVGratuitas": "0.00",
            "tipoMoneda": "PEN",
            "mtoOperGravadas": "60.86",
            "mtoImpVenta": "71.82",
            "legends": [
            {
            "code": "1000",
            "value": "SETENTA Y UNO CON 82/100 SOLES"
            }
            ],
            "mtoOperExoneradas": "0.00",
            "desMotivo": "RETENCION",
            "numDocfectado": "F001-5097",
            "tipDocAfectado": "01",
            "serie": "FC01",
            "tipoDoc": "07",
            "client": {
            "rznSocial": "INVERSIONES FAVEL E.I.R.L",
            "address": {
            "distrito": "-",
            "direccion": "PSJ SR.MILAGROS N.103",
            "ubigueo": "140101",
            "departamento": "-",
            "provincia": "-",
            "codigoPais": "PE"
            },
            "tipoDoc": "6",
            "numDoc": "20511038317"
            },
            "details": [
            {
            "descripcion": "DSCTO POR RETENCION",
            "porcentajeIgv": "18.00",
            "mtoValorVenta": "60.86",
            "totalImpuesto": "10.96",
            "mtoValorGratuito": 0,
            "unidad": "NIU",
            "mtoPrecioUnitario": "71.8200",
            "mtoBaseIgv": "60.86",
            "codProducto": "125003",
            "mtoValorUnitario": "60.8644",
            "igv": "10.96",
            "cantidad": "1.00",
            "tipAfeIgv": "10"
            }
            ],
            "codLocal": "0000",
            "mtoOperInafectas": "0.00"
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
                "value": "Contado PEN 36.000000"
              },
              {
                  "name": "CAJERO",
                "value": "delfina"
              },
              {
                  "name": "OBSERVACIÓN",
                "value": "__________________________________________________\n*NO SE ACEPTARÁN DEVOLUCIONES PARA PRODUCTOS DE SISTEMA ELÉCTRICO"
              }
            ],
            "logo": ""
          },
          "stringQr" : "puyu.pe",
          "documentFooter": null
        }';
        return json_decode($params);
    }
}
