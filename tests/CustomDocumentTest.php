<?php

namespace PuyuPe\Qillqay\Tests;

use PuyuPe\Qillqay\Generate;

use PHPUnit\Framework\TestCase;

class CustomDocumentTest extends TestCase
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
           "company":{
              "ruc":"10123456789",
              "razonSocial":"EMPRESA TEST",
              "nombreComercial":"EMPRESA TEST S.R.L.",
              "address":{
                 "ubigueo":"030101",
                 "codigoPais":"PE",
                 "departamento":"Apurímac",
                 "provincia":"Abancay",
                 "distrito":"Abancay",
                 "urbanizacion":null,
                 "direccion":"AV. BRILLA EL SOL MZ. X Lt. 46 - URB. BELLA VISTA BAJA - ABANCAY - APURIMAC",
                 "codLocal":"0000"
              },
              "email":null,
              "telephone":null
           },
           "tipoOperacion":"0101",
           "tipoDoc":"00",
           "tipoDocNombre": "PROFORMA",
           "serie":"P001",
           "correlativo":207,
           "fechaEmision":"2023-10-10 15:51:13",
           "tipoMoneda":"PEN",
           "mtoOperGravadas":0,
           "mtoOperExoneradas":"40.00",
           "mtoOperInafectas":0,
           "mtoISC":0,
           "mtoIGV":0,
           "sumDsctoGlobal":0,
           "totalAnticipios":0,
           "totalImpuestos":0,
           "valorVenta":"40.00",
           "subTotal":"40.00",
           "mtoImpVenta":"40.00",
           "formaPago":{
              "moneda":"PEN",
              "tipo":"Contado",
              "monto":"40.00"
           },
           "cuotas":null,
           "codLocal":"0000",
           "client":{
              "tipoDoc":1,
              "numDoc":"28715164",
              "rznSocial":"HUAMAN LIMA LEONCIO ARMANDO",
              "email":null,
              "address":{
                 "ubigueo":"-",
                 "direccion":"-"
              }
           },
           "detailsHeader":[
              {
                 "title" : "UNIDAD",
                 "field" : "unidad"
             },
             {
                 "title" : "CANTIDAD",
                 "field" : "cantidad"
             },
             {
                 "title" : "CODIGO",
                 "field" : "codProducto"
             },
             {
                 "title" : "DESCRIPCION",
                 "field" : "descripcion",
                 "align" : "left"
             },
             {
                 "title" : "PRECIO UNITARIO",
                 "field" : "mtoPrecioUnitario"
             },
             {
                 "title" : "PRECIO TOTAL",
                 "field" : "total"
             }
           ],
           "details":[
              {
                 "unidad":"ZZ",
                 "cantidad":1,
                 "codProducto": "0100011",
                 "descripcion":"SERVICIO DE TRANSPORTE PASAJERO:<br> 28715164-HUAMAN LIMA LEONCIO ARMANDO,<br> RUTA: ANDAHUAYLAS-AYACUCHO,<br> VIAJE: 05/09/2023 10:00 AM",
                 "mtoPrecioUnitario":"40.00",
                 "total":"40.00"
              },
              {
                 "unidad":"ZZ",
                 "cantidad":1,
                 "codProducto": "0100011",
                 "descripcion":"SERVICIO DE TRANSPORTE PASAJERO:<br> 28715164-HUAMAN LIMA LEONCIO ARMANDO,<br> RUTA: ANDAHUAYLAS-AYACUCHO,<br> VIAJE: 05/09/2023 10:00 AM",
                 "mtoPrecioUnitario":"40.00",
                 "total":"40.00"
              }
           ],
           "detailsSummary":[
             {
                 "title" : "TOTAL",
                 "value" : "40.00"
             }
           ],
           "legends":[
              {
                 "code":"1000",
                 "value":"CUARENTA CON 00/100 SOLES"
              }
           ],
           "observation":null,
           "cashier":{
              "tipoDoc":1,
              "numDoc":"-",
              "rznSocial":"LILA"
           }
        }';

        return json_decode($cpeJSON);
    }

    private function getParams()
    {
        $params = '{
           "system":{
              "hash": "dasdasdasd",
              "appMessage":"Emitido desde YUBIZ.PUYU.PE",
              "background":"#154c79",
              "anulled":false,
              "production":true
           },
           "user":{
              "footer":"MUCHAS GRACIAS POR SU PREFERENCIA</br>",
              "header":null,
              "extras":[
                 {
                    "name":"FORMA DE PAGO",
                    "value":"Contado PEN 36.00"
                 },
                 {
                    "name":"CAJERO",
                    "value":"delfina"
                 },
                 {
                    "name":"OBSERVACIÓN",
                    "value":""
                 }
              ]
           },
           "stringQr":null,
           "documentFooter": "TEST DE FOOTER ADICIONAL\\nESTO ES UNA LINEA ADICIONAL"
        }';
        return json_decode($params);
    }
}
