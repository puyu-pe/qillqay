<?php
namespace PuyuPe\Qillqay\Tests;

use PuyuPe\Qillqay\Generate;

use PHPUnit\Framework\TestCase;

class FacturaTicketTest extends TestCase
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
          "ruc": "20450523381",
          "razonSocial": "EMPRESA DE TRANSPORTES REY DE LOS ANDES DE AYMARAES - PAMPAMARCA S.R.L.",
          "nombreComercial": "REY DE LOS ANDES",
          "address": {
          "ubigueo": "030101",
          "codigoPais": "PE",
          "departamento": "APURIMAC",
          "provincia": "ABANCAY",
          "distrito": "ABANCAY",
          "urbanizacion": null,
          "direccion": "AV. BRASIL NRO. 216 - URB. LAS AMÉRICAS",
          "codLocal": "0000"
          },
          "email": null,
          "telephone": "989290733"
          },
          "tipoOperacion": "0101",
          "tipoDoc": "01",
          "serie": "FP01",
          "correlativo": 4639,
          "fechaEmision": "2023-12-21 09:26:51",
          "fechaVencimiento": "2023-12-21",
          "tipoMoneda": "PEN",
          "mtoOperGravadas": 0,
          "mtoOperExoneradas": "14.00",
          "mtoOperInafectas": 0,
          "mtoISC": 0,
          "mtoIGV": 0,
          "mtoCargos": 0,
          "mtoDescuentos": 0,
          "mtoOperGratuitas": 0,
          "sumDsctoGlobal": 0,
          "totalAnticipios": 0,
          "totalImpuestos": 0,
          "valorVenta": "14.00",
          "subTotal": "14.00",
          "mtoImpVenta": "14.00",
          "formaPago": {
          "moneda": "PEN",
          "tipo": "Contado",
          "monto": "14.00"
          },
          "cuotas": null,
          "formato": "ticket",
          "codLocal": "0000",
          "client": {
          "tipoDoc": "6",
          "numDoc": "20148183083",
          "rznSocial": "MUNICIPALIDAD DISTRITO DE SORAYA",
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
          "codProducto": "",
          "codProdSunat": "",
          "descripcion": "SERVICIO DE TRANSPORTE DE PASAJERO:<br>DNI 31361256 - TORRES DAVILA ROBERLIZ KAREM<br>RUTA: CHACAPUENTE-ABANCAY<br>FECHA: 21/12/2023, HORA:07:40 AM<br>ASIENTO: 1",
          "isc": 0,
          "porcentajeIgv": 18,
          "igv": 0,
          "totalImpuestos": 0,
          "mtoBaseIgv": "14.00",
          "mtoValorVenta": "14.00",
          "mtoValorUnitario": "14.00",
          "mtoPrecioUnitario": "14.00",
          "tipAfeIgv": "20",
          "atributos": [
          {
          "name": "Numero de asiento",
          "code": "3010",
          "value": 1
          },
          {
          "name": "Número de documento de identidad del pasajero",
          "code": "3010",
          "value": "31361256"
          },
          {
          "name": "Tipo de documento de identidad del pasajero",
          "code": "3010",
          "value": "1"
          },
          {
          "name": "Nombres y apellidos del pasajero",
          "code": "3010",
          "value": "TORRES DAVILA ROBERLIZ KAREM"
          },
          {
          "name": "Ciudad o lugar de origen",
          "code": "3008",
          "value": null
          },
          {
          "name": "Ciudad o lugar de origen",
          "code": "3008",
          "value": "CHACAPUENTE"
          },
          {
          "name": "Ciudad o lugar de destino",
          "code": "3009",
          "value": null
          },
          {
          "name": "Ciudad o lugar de destino",
          "code": "3009",
          "value": "ABANCAY"
          },
          {
          "name": "Fecha de inicio programado",
          "code": "3010",
          "value": "2023-12-21"
          },
          {
          "name": "Hora de inicio programado",
          "code": "3010",
          "value": "07:40:00"
          }
          ]
          }
          ],
          "legends": [
          {
          "code": "1000",
          "value": "CATORCE CON 00/100 SOLES"
          }
          ],
          "observation": null,
          "cashier": {
          "tipoDoc": 1,
          "numDoc": "-",
          "rznSocial": "ELVIS"
          }
          }';

        return json_decode($cpeJSON);
    }

    private function getParams()
    {
        $params = '{
          "system": {
            "hash": "m70vBMajaapHr5ByjkwEER8tCjc=",
            "background": "#000000",
            "appMessage" : "Emitido desde YUBIZ.PUYU.PE",
            "anulled": false,
            "rejected": false,
            "production": true
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
