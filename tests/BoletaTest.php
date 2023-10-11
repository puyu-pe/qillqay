<?php

namespace PuyuPe\NexusPdf\Tests;

use PuyuPe\NexusPdf\PdfGenerator;

use PHPUnit\Framework\TestCase;

class BoletaTest extends TestCase
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

//echo json_encode($data);
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
          },"tipoOperacion": "0101",
            "tipoDoc": "03",
            "serie": "B001",
            "correlativo": 6032,
            "fechaEmision": "2023-09-05 15:51:13",
            "fechaVencimiento": "2023-09-05",
            "tipoMoneda": "PEN",
            "mtoOperGravadas": 0,
            "mtoOperExoneradas": "40.00",
            "mtoOperInafectas": 0,
            "mtoISC": 0,
            "mtoIGV": 0,
            "sumDsctoGlobal": 0,
            "totalAnticipios": 0,
            "totalImpuestos": 0,
            "valorVenta": "40.00",
            "subTotal": "40.00",
            "mtoImpVenta": "40.00",
            "formaPago": {
            "moneda": "PEN",
            "tipo": "Contado",
            "monto": "40.00"
            },
            "cuotas": null,
            "codLocal": "0000",
            "client": {
            "tipoDoc": 1,
            "numDoc": "28715164",
            "rznSocial": "HUAMAN LIMA LEONCIO ARMANDO",
            "email": null,
            "address": {
            "ubigueo": "-",
            "direccion": "-"
            }
            },
            "details": [
            {
            "unidad": "ZZ",
            "cantidad": 1,
            "sumOtrosCargos": 0,
            "cargos": 0,
            "codProducto": null,
            "codProdSunat": null,
            "descripcion": "SERVICIO DE TRANSPORTE PASAJERO: 28715164-HUAMAN LIMA LEONCIO ARMANDO, RUTA: ANDAHUAYLAS-AYACUCHO, VIAJE: 05/09/2023 10:00 AM",
            "isc": 0,
            "porcentajeIgv": 18,
            "igv": 0,
            "totalImpuestos": 0,
            "mtoBaseIgv": "40.00",
            "mtoValorVenta": "40.00",
            "mtoValorUnitario": "40.00",
            "mtoPrecioUnitario": "40.00",
            "tipAfeIgv": "20"
            }
            ],
            "legends": [
            {
            "code": "1000",
            "value": "CUARENTA CON 00/100 SOLES"
            }
            ],
            "observation": null,
            "cashier": {
            "tipoDoc": 1,
            "numDoc": "-",
            "rznSocial": "LILA"
            }
            }';

        return json_decode($cpeJSON);
    }

    private function getParams()
    {
        $params = '{
          "system": {
            "hash": "m70vBMajaapHr5ByjkwEER8tCjc=",
            "background": "#154c79",
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
