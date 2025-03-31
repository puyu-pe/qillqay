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
    "direccion": "AV. PANAMERICANA NRO. 1517",
    "codLocal": "0000"
    },
    "email": null,
    "telephone": "(083) 200645 - 984626295 - 956774588"
    },
    "tipoOperacion": "0101",
    "formato": "a4",
    "tipoDoc": "01",
    "codLocal": "0000",
    "serie": "F001",
    "correlativo": "7302",
    "fechaEmision": "2025-02-28 11:49:59",
    "fechaVencimiento": "2025-03-28",
    "tipoMoneda": "PEN",
    "mtoOperGravadas": "122.8813",
    "mtoOperExoneradas": "0.0000",
    "mtoOperInafectas": "0.0000",
    "mtoIGV": "22.1187",
    "totalImpuestos": "22.1187",
    "valorVenta": "122.8813",
    "subTotal": "145.0000",
    "mtoImpVenta": "145.0000",
    "formaPago": {
    "moneda": "PEN",
    "tipo": "Credito",
    "monto": "145.0000"
    },
    "cuotas": [
    {
    "moneda": "PEN",
    "fechaPago": "2025-03-28",
    "monto": "145.0000"
    }
    ],
    "client": {
    "tipoDoc": "6",
    "numDoc": "20104888934",
    "rznSocial": "CAJA MUNICIPAL DE AHORRO Y CREDITO DE ICA SA",
    "address": {
    "ubigueo": "-",
    "direccion": "AV. CONDE DE NIEVA NRO. 498 ICA - ICA - ICA"
    },
    "email": "",
    "telephone": ""
    },
    "cashier": {
    "tipoDoc": 1,
    "numDoc": "-",
    "rznSocial": "YESSENIA"
    },
    "details": [
    {
    "codProducto": "50920107624",
    "unidad": "NIU",
    "descripcion": "MANTENIMIENTO GENERAL",
    "cantidad": "1.00",
    "mtoValorUnitario": "55.0847",
    "mtoValorVenta": "55.0847",
    "mtoBaseIgv": "55.0847",
    "porcentajeIgv": "18",
    "igv": "9.9153",
    "tipAfeIgv": "10",
    "totalImpuestos": "9.9153",
    "mtoPrecioUnitario": "65.00"
    },
    {
    "codProducto": "00114901154",
    "unidad": "NIU",
    "descripcion": "ACEITE MOTUL 7100 20W50 SINTETICO 4T 1L",
    "cantidad": "1.00",
    "mtoValorUnitario": "44.0678",
    "mtoValorVenta": "44.0678",
    "mtoBaseIgv": "44.0678",
    "porcentajeIgv": "18",
    "igv": "7.9322",
    "tipAfeIgv": "10",
    "totalImpuestos": "7.9322",
    "mtoPrecioUnitario": "52.00"
    },
    {
    "codProducto": "29416812021",
    "unidad": "NIU",
    "descripcion": "ZAPATA POSTERIOR",
    "cantidad": "1.00",
    "mtoValorUnitario": "23.7288",
    "mtoValorVenta": "23.7288",
    "mtoBaseIgv": "23.7288",
    "porcentajeIgv": "18",
    "igv": "4.2712",
    "tipAfeIgv": "10",
    "totalImpuestos": "4.2712",
    "mtoPrecioUnitario": "28.00"
    }
    ],
    "legends": [
    {
    "code": "1000",
    "value": "CIENTO CUARENTA Y CINCO  CON 00/100 SOLES."
    }
    ],
    "observation": " CEL : 991228607\nPLACA: 6541-HC\nENCARGADO : ARTUR NUÑOZ\n\n\n- Generado desde: FACTURA ELÉCTRONICA F001 - 7158 el 21/02/2025 \n\n- Generado desde: FACTURA ELÉCTRONICA F001 - 7277 el 28/02/2025 \n",
    "documentFooter": ""
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
            "rejected": false,
            "production": true
          },
          "user": {
            "footer": "MUCHAS GRACIAS POR SU PREFERENCIA</br></br><div>Consulte el documento electrónico en :</br>http://localhost:8080/10123456789</div><br>",
            "header": "<center>TALLER MULTIMARCA<br>VENTA DE REPUESTOS Y SERVICIOS</center><br>Contacto : 984626295 - 956774588 - garymotors@gmail.com",
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
                "value": " CEL : 991228607\nPLACA: 6541-HC\nENCARGADO : ARTUR NUÑOZ\n\n\n- Generado desde: FACTURA ELÉCTRONICA F001 - 7158 el 21/02/2025 \n\n- Generado desde: FACTURA ELÉCTRONICA F001 - 7277 el 28/02/2025"
              }
            ],
            "logo": ""
          },
          "stringQr" : "puyu.pe",
          "documentFooter": "Realice su pago es en los siguientes números de cuenta.\nBCP - Inversiones AUTOVET S.R.L\nNro. De Cta. Corriente: 200-2083884-0-33\nCCI: 00220000208388403346\n_________________________________________________\nBanco de la Nación - Inversiones AUTOVET S.R.L\nNro. De Cta.: 00-181-072008\nCCI: 0181810001810720084\nCta. De detracciones: 00-181-042486\n_________________________________________________\nEdwin David Velázquez Tica\nN.º de Cta.: 588-3082449630\nCCI: 00358801308244963016"
        }';
    return json_decode($params);
  }
}
