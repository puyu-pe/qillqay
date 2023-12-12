<?php

namespace PuyuPe\Qillqay\Tests;

use PuyuPe\Qillqay\Generate;

use PHPUnit\Framework\TestCase;

class FacturaTest extends TestCase
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
          "tipoOperacion": "0101",
          "formato": "a4",
          "tipoDoc": "01",
          "codLocal": "0000",
          "serie": "F001",
          "correlativo": "4863",
          "fechaEmision": "2023-09-06 10:45:19",
          "fechaVencimiento": "2023-09-24",
          "tipoMoneda": "PEN",
          "mtoOperGravadas": "30.5084",
          "mtoOperExoneradas": "0.0000",
          "mtoOperInafectas": "0.0000",
          "mtoIGV": "5.4916",
          "totalImpuestos": "5.4916",
          "valorVenta": "30.5084",
          "subTotal": "36.0000",
          "mtoImpVenta": "36.0000",
          "guias": [
            {
              "tipoDoc": "09",
              "nroDoc": "T001-123"
            }
          ],
          "formaPago": {
            "moneda": "PEN",
            "tipo": "Contado",
            "monto": "36.000000"
          },
          "cuotas": [],
          "client": {
            "tipoDoc": "6",
            "numDoc": "10310122365",
            "rznSocial": "VIZCARRA ASCARZA MARCOS",
            "address": {
              "ubigueo": "-",
              "direccion": "-"
            },
            "email": null,
            "telephone": "983602438"
          },
          "cashier": {
            "tipoDoc": 1,
            "numDoc": "-",
            "rznSocial": "delfina"
          },
          "details": [
            {
              "codProducto": "02011310784",
              "unidad": "NIU",
              "descripcion": "VALVULA SCOOTER 150 GY6 DMC COPILAR",
              "cantidad": "1.0000",
              "mtoValorUnitario": "15.2542",
              "mtoValorVenta": "15.2542",
              "mtoBaseIgv": "15.2542",
              "porcentajeIgv": "18",
              "igv": "2.7458",
              "tipAfeIgv": "10",
              "totalImpuestos": "2.7458",
              "mtoPrecioUnitario": "18.0000"
            },
            {
              "codProducto": "-",
              "unidad": "NIU",
              "descripcion": "VALVULA SCOOTER 150 GY6 ESC COPILAR",
              "cantidad": "1.0000",
              "mtoValorUnitario": "15.2542",
              "mtoValorVenta": "15.2542",
              "mtoBaseIgv": "15.2542",
              "porcentajeIgv": "18",
              "igv": "2.7458",
              "tipAfeIgv": "10",
              "totalImpuestos": "2.7458",
              "mtoPrecioUnitario": "18.0000"
            }
          ],
          "legends": [
            {
              "code": "1000",
              "value": "TREINTA Y SEIS  CON 00/100 SOLES."
            }
          ],
          "observation": "MENSAJE FINAL",
          "documentFooter": null
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
          "stringQr" : "puyu.pe",
          "documentFooter": null
        }';
        return json_decode($params);
    }
}
