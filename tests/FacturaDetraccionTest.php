<?php

namespace PuyuPe\Qillqay\Tests;

use PuyuPe\Qillqay\Generate;

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
              "ruc":"20490793624",
              "razonSocial":"INVERSIONES AUTOVET S.R.L.",
              "nombreComercial":"INVERSIONES AUTOVET S.R.L.",
              "address":{
                 "ubigueo":"030101",
                 "codigoPais":"PE",
                 "departamento":"Apur\u00edmac",
                 "provincia":"Abancay",
                 "distrito":"Abancay",
                 "urbanizacion":null,
                 "direccion":"AV. Canad\u00e1 A-01 INT. Las Amer\u00edcas - Abancay - Apur\u00edmac",
                 "codLocal":"0000"
              },
              "email":null,
              "telephone":null
           },
           "tipoOperacion":"1001",
           "formato":"a4",
           "tipoDoc":"01",
           "codLocal":"0000",
           "serie":"F001",
           "correlativo":"1154",
           "fechaEmision":"2023-10-10 10:50:33",
           "fechaVencimiento":"2023-10-31",
           "tipoMoneda":"PEN",
           "mtoOperGravadas":"1372.8814",
           "mtoOperExoneradas":"0.0000",
           "mtoOperInafectas":"0.0000",
           "mtoIGV":"247.1186",
           "totalImpuestos":"247.1186",
           "valorVenta":"1372.8814",
           "subTotal":"1620.0000",
           "mtoImpVenta":"1620.0000",
           "formaPago":{
              "moneda":"PEN",
              "tipo":"Credito",
              "monto":"1620.000000"
           },
           "cuotas":[
              {
                 "moneda":"PEN",
                 "fechaPago":"2023-10-31",
                 "monto":"1620.000000"
              }
           ],
           "client":{
              "tipoDoc":"6",
              "numDoc":"20491240319",
              "rznSocial":"UNIDAD EJECUTORA RED DE SALUD ANTABAMBA",
              "address":{
                 "ubigueo":"-",
                 "direccion":"PASAJE LOS AMAUTAS  S\/N ANTABAMBA - ANTABAMBA- APURIMAC"
              },
              "email":null,
              "telephone":null
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
                 "descripcion":"MANTENIMIENTO&nbsp;CORRECTIVO&nbsp;DE&nbsp;CAMIONETA<br>MANTENIMIENTO&nbsp;PREVENTIVO&nbsp;Y&nbsp;CORRECTIVO&nbsp;QUE&nbsp;INCLUYE&nbsp;REPUESTO&nbsp;Y&nbsp;<br>SERVICIO:&nbsp;02&nbsp;RODAJES&nbsp;DE&nbsp;RUEDA&nbsp;POSTERIOR,&nbsp;04&nbsp;RETEN&nbsp;INTERIOR&nbsp;DE&nbsp;<br>FUNDA&nbsp;POSTERIOR,&nbsp;04&nbsp;RETENEDORES&nbsp;DE&nbsp;RODAJE&nbsp;DE&nbsp;EJE&nbsp;POSTERIOR,&nbsp;<br>SEGUN&nbsp;O\/S&nbsp;N\u00b0&nbsp;66,&nbsp;SIAF&nbsp;331",
                 "cantidad":"1.0000",
                 "mtoValorUnitario":"1372.8814",
                 "mtoValorVenta":"1372.8814",
                 "mtoBaseIgv":"1372.8814",
                 "porcentajeIgv":"18",
                 "igv":"247.1186",
                 "tipAfeIgv":"10",
                 "totalImpuestos":"247.1186",
                 "mtoPrecioUnitario":"1620.0000"
              }
           ],
           "legends":[
              {
                 "code":"1000",
                 "value":"UN MIL SEISCIENTOS VEINTE  CON 00\/100 SOLES."
              },
              {
                 "code":"2006",
                 "value":"Operaci\u00f3n sujeta al Sistema de Pago de Obligaciones Tributarias con el Gobierno Central."
              }
           ],
           "observation":"DE LA UNIDAD VEHICULAR TOYOTA HILUX DE PLACA: EGS-926 DEL P.S.  PACHACONAS\n- Generado desde: FACTURA EL\u00c9CTRONICA F001-1153 el 10\/10\/2023",
           "documentFooter":"Realice su pago es en los siguientes n\u00fameros de cuenta.\nBCP - Inversiones AUTOVET S.R.L\nNro. De Cta. Corriente: 200-2083884-0-33\nCCI: 00220000208388403346\n_________________________________________________\nBanco de la Naci\u00f3n - Inversiones AUTOVET S.R.L\nNro. De Cta.: 00-181-072008\nCCI: 0181810001810720084\nCta. De detracciones: 00-181-042486\n_________________________________________________\nEdwin David Vel\u00e1zquez Tica\nN.\u00ba de Cta.: 588-3082449630\nCCI: 00358801308244963016",
           "detraccion":{
              "valueRef":null,
              "codBienDetraccion":"020",
              "codMedioPago":"001",
              "ctaBanco":"00181042486",
              "percent":"4",
              "mount":"64.8000"
           }
        }
        ';

        return json_decode($cpeJSON);
    }

    private function getParams()
    {
        $params = '{
                "system": {
            "hash": " bRoSBxDB2XKl4i+K/avDNKLWp+0=",
            "background": "#ec2222",
            "anulled": false,
            "rejected": false,
            "is_production": true
          },
          "user": {
                    "footer": "MUCHAS GRACIAS POR SU PREFERENCIA</br></br><div>Consulte el documento electrónico en :</br>https://nexus.puyu.pe/20490793624</div><br>",
            "header": "SERVICIO DE MECANICA AUTOMOTRIZ INTEGRAL Y VENTA DE REPUESTOS",
            "extras": [
              {
                "name": "FORMA DE PAGO",
                "value": "Credito PEN 1620.00"
              },
              {
                "name": "CAJERO",
                "value": "logistica"
              },
              {
                "name": "OBSERVACIÓN",
                "value": "DE LA UNIDAD VEHICULAR TOYOTA HILUX DE PLACA: EGS-926, DEL P.S. PACHACONAS"
              }
            ],
            "logo": ""
          },
          "stringQr" : "puyu.pe",
          "documentFooter": "Realice su pago es en los siguientes n\u00fameros de cuenta.\nBCP - Inversiones AUTOVET S.R.L\nNro. De Cta. Corriente: 200-2083884-0-33\nCCI: 00220000208388403346\n_________________________________________________\nBanco de la Naci\u00f3n - Inversiones AUTOVET S.R.L\nNro. De Cta.: 00-181-072008\nCCI: 0181810001810720084\nCta. De detracciones: 00-181-042486\n_________________________________________________\nEdwin David Vel\u00e1zquez Tica\nN.\u00ba de Cta.: 588-3082449630\nCCI: 00358801308244963016"
        }';
        return json_decode($params);
    }
}
