<?php
namespace PuyuPe\Qillqay\Tests;

use PuyuPe\Qillqay\Generate;

use PHPUnit\Framework\TestCase;

class BoletaTicketTest extends TestCase
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
    "ruc": "20527056579",
    "razonSocial": "EMPRESA TEST S.A.",
    "nombreComercial": null,
    "address": {
      "ubigueo": "030109",
      "codigoPais": "PE",
      "departamento": "Apur\u00EDmac",
      "provincia": "Abancay",
      "distrito": "Abancay",
      "urbanizacion": null,
      "direccion": "Av. Garcilazo de la Vega S/N",
      "codLocal": "0000"
    },
    "email": null,
    "telephone": "083-321965"
  },
  "tipoOperacion": "0101",
  "formato": "ticket",
  "tipoDoc": "03",
  "codLocal": "0000",
  "serie": "B001",
  "correlativo": "25735",
  "fechaEmision": "2023-09-19 09:12:58",
  "fechaVencimiento": "2023-09-19",
  "tipoMoneda": "PEN",
  "mtoOperGravadas": "0.0000",
  "mtoOperExoneradas": "6.0000",
  "mtoOperInafectas": "0.0000",
  "mtoIGV": "0.0000",
  "totalImpuestos": "0.0000",
  "valorVenta": "6.0000",
  "subTotal": "6.0000",
  "mtoImpVenta": "6.0000",
  "formaPago": {
    "moneda": "PEN",
    "tipo": "Contado",
    "monto": "6.000000"
  },
  "cuotas": [],
  "client": {
    "tipoDoc": "1",
    "numDoc": "70430738",
    "rznSocial": "LUIS ALFREDO HUAMANI QUISPE",
    "address": {
      "ubigueo": "-",
      "direccion": null
    },
    "email": "huamaniquispeluisalberto@gmail.com",
    "telephone": null
  },
  "cashier": {
    "tipoDoc": 1,
    "numDoc": "-",
    "rznSocial": "ucaja"
  },
  "details": [
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    },
    {
      "codProducto": "1.3.23.14.1",
      "unidad": "NIU",
      "descripcion": "CONSTANCIA DE NOTAS POR SEMESTRE",
      "cantidad": "1.0000",
      "mtoValorUnitario": "6.0000",
      "mtoValorVenta": "6.0000",
      "mtoBaseIgv": "6.0000",
      "porcentajeIgv": 0,
      "igv": 0,
      "tipAfeIgv": "20",
      "totalImpuestos": 0,
      "mtoPrecioUnitario": "6.0000"
    }
  ],
  "legends": [
    {
      "code": "1000",
      "value": "SEIS  CON 00/100 SOLES."
    }
  ],
  "observation": null,
  "documentFooter": null
}';

        return json_decode($cpeJSON);
    }

    private function getParams()
    {
        $params = '{
          "system": {
            "hash": " nFLJprnSa4WFbxvO/YE9nRcNnbc=",
            "background": "#123456",
            "appMessage" : "Emitido desde YUBIZ.PUYU.PE",
            "anulled": false,
            "rejected": false,
            "production": true
          },
          "user": {
            "footer": "Representación impresa del CPE, consulta en:<br>https://nexus.puyu.pe/20527056579<br>",
            "header": null,
            "extras": [
              {
                "name": "FORMA DE PAGO",
                "value": "Contado PEN 6.00"
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
            "logo": null
          },
          "stringQr" : "puyu.pe",
          "documentFooter": null
        }';
        return json_decode($params);
    }
}
