<?php
namespace PuyuPe\NexusPdf\Tests;

use PuyuPe\NexusPdf\PdfGenerator;

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
"serie": "FE01",
"correlativo": 1060,
"fechaEmision": "2023-09-11 09:26:47",
"fechaVencimiento": "2023-09-11",
"tipoMoneda": "PEN",
"mtoOperGravadas": "3.39",
"mtoOperExoneradas": 0,
"mtoOperInafectas": 0,
"mtoISC": 0,
"mtoIGV": "0.61",
"totalImpuestos": "0.61",
"valorVenta": "3.39",
"subTotal": "4.00",
"mtoImpVenta": "4.00",
"formaPago": {
"moneda": "PEN",
"tipo": "Contado",
"monto": "4.00"
},
"cuotas": null,
"formato": "ticket",
"codLocal": "0000",
"client": {
"tipoDoc": "6",
"numDoc": "20526918429",
"rznSocial": "COOPERATIVA DE AHORRO Y CREDITO LOS ANDES COTARUSI AYMARAES",
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
"codProducto": "-",
"codProdSunat": null,
"descripcion": "SERVICIO DE TRANSPORTE: 1 SOBRE MANILA",
"porcentajeIgv": 18,
"igv": "0.61",
"tipAfeIgv": "10",
"totalImpuestos": "0.61",
"mtoBaseIgv": "3.39",
"mtoValorVenta": "3.39",
"mtoValorUnitario": "3.39",
"mtoPrecioUnitario": "4.00"
}
],
"legends": [
{
"code": "1000",
"value": "CUATRO CON 00/100 SOLES"
}
],
"observation": "1 SOBRE",
"cashier": {
"tipoDoc": 1,
"numDoc": "-",
"rznSocial": "MONICA"
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
