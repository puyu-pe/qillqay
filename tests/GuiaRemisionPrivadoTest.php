<?php

namespace PuyuPe\Qillqay\Tests;

use PuyuPe\Qillqay\Generate;

use PHPUnit\Framework\TestCase;

class GuiaRemisionPrivadoTest extends TestCase
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
                "ruc": "20607852848",
                "razonSocial": "GRUPO OXIPERU SOCIEDAD COMERCIAL DE RESPONSABILIDAD LIMITADA",
                "nombreComercial": "GRUPO OXIPERU S.R.L.",
                "address": {
                "ubigueo": "080104",
                "codigoPais": "PE",
                "departamento": "CUSCO",
                "provincia": "CUSCO",
                "distrito": "CUSCO",
                "urbanizacion": null,
                "direccion": "AV. PROLONGACION AV LA CULTURA NRO. 8 URB. URB TRES DE MAYO",
                "codLocal": "0000"
                },
                "email": null,
                "telephone": "931587800 - 931587801"
            },
            "tipoDoc": "09",
            "serie": "T001",
            "correlativo": "159",
            "fechaEmision": "2025-01-11",
            "observation": "",
            "destinatario": {
                "tipoDoc": "6",
                "numDoc": "20558365740",
                "rznSocial": "MULTISERVICIOS EL VOLVITO EIRL"
            },
            "envio": {
                "modTraslado": "02",
                "codTraslado": "01",
                "desTraslado": "VENTA",
                "fecTraslado": "2025-01-11",
                "indTransbordo": 0,
                "pesoTotal": "920.00",
                "undPesoTotal": "KGM",
                "choferes": [
                {
                    "tipo": "Principal",
                    "tipoDoc": "1",
                    "nroDoc": "71867114",
                    "nombres": "Ivan Rodrigo",
                    "apellidos": "Quispe Gonsalo",
                    "licencia": "Q71867114"
                }
                ],
                "vehiculo": {
                "placa": "X5C731",
                "codEmisor": "string",
                "nroAutorizacion": ""
                },
                "partida": {
                "ubigeo": "080104",
                "direccion": "Av. La cultura Urb 3 de mayo b8 - San Jeronimo"
                },
                "llegada": {
                "ubigeo": "030401",
                "direccion": "Chalhuahuacho - Cotabambas - Apurimac"
                }
            },
            "details": [
                {
                "codigo": "295",
                "descripcion": "CILINDRO DE OXIGENO<br />\n",
                "unidad": "NIU",
                "cantidad": "12.00"
                },
                {
                "codigo": "296",
                "descripcion": "CILINDRO DE ACETILENO<br />\nserie: 219069350<br />\nserie: 58164<br />\nserie: 219069067<br />\n",
                "unidad": "NIU",
                "cantidad": "3.00"
                },
                {
                "codigo": "294",
                "descripcion": "CILINDRO DE NITROGENO<br />\n",
                "unidad": "NIU",
                "cantidad": "1.00"
                }
            ]
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
            "rejected": false,
            "production": true
          },
          "user": {
                    "footer": "MUCHAS GRACIAS POR SU PREFERENCIA</br></br><div>Consulte el documento electrónico en :</br>http://localhost:8080/10123456789</div><br>",
            "header": null,
            "extras": [ ],
            "logo": ""
          },
          "stringQr" : "puyu.pe",
          "documentFooter": null
        }';
        return json_decode($params);
    }
}
