<?php

namespace PuyuPe\Qillqay\Tests;

use PuyuPe\Qillqay\Generate;

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
      "ruc":"20602974503",
      "razonSocial":"GARY MOTORS DMG S.R.L.",
      "nombreComercial":"GARY MOTORS DMG S.R.L.",
      "address":{
         "ubigueo":"030101",
         "codigoPais":"PE",
         "departamento":"Apur\u00edmac",
         "provincia":"Abancay",
         "distrito":"Abancay",
         "urbanizacion":null,
         "direccion":"AV. PANAMERICANA NRO. 1517",
         "codLocal":"0000"
      },
      "email": "mail@mail.com",
      "telephone":"(083) 200645"
   },
   "tipoOperacion":"0101",
   "formato":"a4",
   "tipoDoc":"03",
   "codLocal":"0000",
   "serie":"B001",
   "correlativo":"25215",
   "fechaEmision":"2023-10-21 17:48:57",
   "fechaVencimiento":"2023-10-21",
   "tipoMoneda":"PEN",
   "mtoOperGravadas":"452.1187",
   "mtoOperExoneradas":"0.0000",
   "mtoOperInafectas":"0.0000",
   "mtoIGV":"81.3813",
   "totalImpuestos":"81.3813",
   "valorVenta":"452.1187",
   "subTotal":"533.5000",
   "mtoImpVenta":"533.5000",
   "formaPago":{
      "moneda":"PEN",
      "tipo":"Contado",
      "monto":"533.500000"
   },
   "client":{
      "tipoDoc":"1",
      "numDoc":"75387146",
      "rznSocial":"RUDIGER SADDAM VARGAS FARFAN",
      "address":{
         "ubigueo":"-",
         "direccion":""
      },
      "email":"",
      "telephone":""
   },
   "cashier":{
      "tipoDoc":1,
      "numDoc":"-",
      "rznSocial":"logistica"
   },
   "details":[
      {
         "codProducto":"-",
         "unidad":"NIU",
         "descripcion":"MANTENIMIENTO&nbsp;GENERAL&nbsp;CAMBIO&nbsp;DE&nbsp;FRENOS&nbsp;DELANT&nbsp;Y&nbsp;POST&nbsp;<br>&nbsp;COMPLETAR&nbsp;PERNO&nbsp;DE&nbsp;PLACA&nbsp;&nbsp;&nbsp;CAMBIO&nbsp;DE&nbsp;BUJIA&nbsp;ENDERESAR&nbsp;BARRA&nbsp;TELESCOPICA&nbsp;",
         "cantidad":"1.0000",
         "mtoValorUnitario":"38.1356",
         "mtoValorVenta":"38.1356",
         "mtoBaseIgv":"38.1356",
         "porcentajeIgv":"18",
         "igv":"6.8644",
         "tipAfeIgv":"10",
         "totalImpuestos":"6.8644",
         "mtoPrecioUnitario":"45.0000"
      },
      {
         "codProducto":"13533010999",
         "unidad":"NIU",
         "descripcion":"GUARDAFANGO DELANT GL LINIAL NEGRO YANGZU",
         "cantidad":"1.0000",
         "mtoValorUnitario":"25.4237",
         "mtoValorVenta":"25.4237",
         "mtoBaseIgv":"25.4237",
         "porcentajeIgv":"18",
         "igv":"4.5763",
         "tipAfeIgv":"10",
         "totalImpuestos":"4.5763",
         "mtoPrecioUnitario":"30.0000"
      },
      {
         "codProducto":"56919810279",
         "unidad":"NIU",
         "descripcion":"KIT DE RODAJE DE TIMON GL150 CONICO 320\/22.5-320\/24  KIGCOL",
         "cantidad":"1.0000",
         "mtoValorUnitario":"22.0339",
         "mtoValorVenta":"22.0339",
         "mtoBaseIgv":"22.0339",
         "porcentajeIgv":"18",
         "igv":"3.9661",
         "tipAfeIgv":"10",
         "totalImpuestos":"3.9661",
         "mtoPrecioUnitario":"26.0000"
      },
      {
         "codProducto":"20433012353",
         "unidad":"NIU",
         "descripcion":"BARRA TELESCOPICA GL150 Z COMPLET ROJO YANGZU",
         "cantidad":"1.0000",
         "mtoValorUnitario":"169.4915",
         "mtoValorVenta":"169.4915",
         "mtoBaseIgv":"169.4915",
         "porcentajeIgv":"18",
         "igv":"30.5085",
         "tipAfeIgv":"10",
         "totalImpuestos":"30.5085",
         "mtoPrecioUnitario":"200.0000"
      },
      {
         "codProducto":"51611-KRE-NEG",
         "unidad":"NIU",
         "descripcion":"PROTECTOR TELESCOPICO BROSS GY NEGRO BJR",
         "cantidad":"1.0000",
         "mtoValorUnitario":"16.9492",
         "mtoValorVenta":"16.9492",
         "mtoBaseIgv":"16.9492",
         "porcentajeIgv":"18",
         "igv":"3.0508",
         "tipAfeIgv":"10",
         "totalImpuestos":"3.0508",
         "mtoPrecioUnitario":"20.0000"
      },
      {
         "codProducto":"29419709834",
         "unidad":"NIU",
         "descripcion":"ZAPATA DE FRENO GL POST GDM",
         "cantidad":"1.0000",
         "mtoValorUnitario":"13.5593",
         "mtoValorVenta":"13.5593",
         "mtoBaseIgv":"13.5593",
         "porcentajeIgv":"18",
         "igv":"2.4407",
         "tipAfeIgv":"10",
         "totalImpuestos":"2.4407",
         "mtoPrecioUnitario":"16.0000"
      },
      {
         "codProducto":"29416812018",
         "unidad":"NIU",
         "descripcion":"ZAPATA DE FRENO GL SFX",
         "cantidad":"1.0000",
         "mtoValorUnitario":"13.5593",
         "mtoValorVenta":"13.5593",
         "mtoBaseIgv":"13.5593",
         "porcentajeIgv":"18",
         "igv":"2.4407",
         "tipAfeIgv":"10",
         "totalImpuestos":"2.4407",
         "mtoPrecioUnitario":"16.0000"
      },
      {
         "codProducto":"02015306415",
         "unidad":"NIU",
         "descripcion":"BUJIA BRASILERA DP8EA-9 NGK",
         "cantidad":"1.0000",
         "mtoValorUnitario":"8.4746",
         "mtoValorVenta":"8.4746",
         "mtoBaseIgv":"8.4746",
         "porcentajeIgv":"18",
         "igv":"1.5254",
         "tipAfeIgv":"10",
         "totalImpuestos":"1.5254",
         "mtoPrecioUnitario":"10.0000"
      },
      {
         "codProducto":"-",
         "unidad":"NIU",
         "descripcion":"pernos",
         "cantidad":"2.0000",
         "mtoValorUnitario":"0.8475",
         "mtoValorVenta":"1.6950",
         "mtoBaseIgv":"1.6950",
         "porcentajeIgv":"18",
         "igv":"0.3050",
         "tipAfeIgv":"10",
         "totalImpuestos":"0.3050",
         "mtoPrecioUnitario":"1.0000"
      },
      {
         "codProducto":"-",
         "unidad":"NIU",
         "descripcion":"MANIJA C\/BASE GL150 FRENO ALA",
         "cantidad":"1.0000",
         "mtoValorUnitario":"11.4407",
         "mtoValorVenta":"11.4407",
         "mtoBaseIgv":"11.4407",
         "porcentajeIgv":"18",
         "igv":"2.0593",
         "tipAfeIgv":"10",
         "totalImpuestos":"2.0593",
         "mtoPrecioUnitario":"13.5000"
      },
      {
         "codProducto":"00114905260",
         "unidad":"NIU",
         "descripcion":"ACEITE 3000 20W50 MOTUL 4T 1LT",
         "cantidad":"1.0000",
         "mtoValorUnitario":"27.1186",
         "mtoValorVenta":"27.1186",
         "mtoBaseIgv":"27.1186",
         "porcentajeIgv":"18",
         "igv":"4.8814",
         "tipAfeIgv":"10",
         "totalImpuestos":"4.8814",
         "mtoPrecioUnitario":"32.0000"
      },
      {
         "codProducto":"43719701200",
         "unidad":"NIU",
         "descripcion":"FOCO DELANT GL LED STROBO STALLION GDM",
         "cantidad":"1.0000",
         "mtoValorUnitario":"27.9661",
         "mtoValorVenta":"27.9661",
         "mtoBaseIgv":"27.9661",
         "porcentajeIgv":"18",
         "igv":"5.0339",
         "tipAfeIgv":"10",
         "totalImpuestos":"5.0339",
         "mtoPrecioUnitario":"33.0000"
      },
      {
         "codProducto":"-",
         "unidad":"NIU",
         "descripcion":"SERVICIO",
         "cantidad":"1.0000",
         "mtoValorUnitario":"76.2712",
         "mtoValorVenta":"76.2712",
         "mtoBaseIgv":"76.2712",
         "porcentajeIgv":"18",
         "igv":"13.7288",
         "tipAfeIgv":"10",
         "totalImpuestos":"13.7288",
         "mtoPrecioUnitario":"90.0000"
      }
   ],
   "legends":[
      {
         "code":"1000",
         "value":"QUINIENTOS TREINTA Y TRES  CON 50\/100 SOLES."
      }
   ],
   "observation":" CEL : 990577706\nPLACA: 0183-3I\n_____________________________ NO SE ACEPTARÁN DEVOLUCIONES PARA PRODUCTOS DE SISTEMA ELÉCTRICO ",
   "documentFooter":""
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
            "rejected": false,
            "production": false
          },
          "user": {
                    "footer": "MUCHAS GRACIAS POR SU PREFERENCIA</br></br><div>Consulte el documento electrónico en :</br>http://localhost:8080/10123456789</div><br>",
            "header": "TALLER MULTIMARCA - VENTA DE REPUESTOS Y SERVICIOS",
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
