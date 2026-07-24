<?php

namespace PuyuPe\Qillqay\Tests;

use PuyuPe\Qillqay\Generate;

use PHPUnit\Framework\TestCase;

class GuiaRemisionPublicoTest extends TestCase
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

    public function testFechaEntregaBienesExplicit()
    {
        $data = $this->getMockedData();
        $data->envio->fecEntregaBienes = '2024-12-15';

        $filePath = Generate::fromObject($data, 'html', $this->config['wkhtmlPath'], 'test');
        $html = file_get_contents($filePath);

        $this->assertStringContainsString('Fecha de entrega de bienes al transportista', $html);
        $this->assertStringContainsString('15/12/2024', $html);
    }

    public function testFechaEntregaBienesFallback()
    {
        $data = $this->getMockedData();

        $filePath = Generate::fromObject($data, 'html', $this->config['wkhtmlPath'], 'test');
        $html = file_get_contents($filePath);

        $this->assertStringContainsString('Fecha de entrega de bienes al transportista', $html);
        $this->assertMatchesRegularExpression(
            '~<strong>Fecha de entrega de bienes al transportista:</strong>\s+01/12/2024~',
            $html,
            'Fallback debe usar fecTraslado en la misma fila que la etiqueta'
        );
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
            "correlativo": "156",
            "fechaEmision": "2024-11-18",
            "observation": "TOTAL  DE CILINDROS :22  UNIDADES ",
            "destinatario": {
                "tipoDoc": "6",
                "numDoc": "20604549401",
                "rznSocial": "AIRPROJECT & CARBIDE PERU S.A.C. - AIRPROJECT & CARBIDE S.A.C."
            },
            "envio": {
                "modTraslado": "01",
                "codTraslado": "13",
                "desTraslado": "OTROS",
                "fecTraslado": "2024-12-01",
                "indTransbordo": 0,
                "pesoTotal": "1100.00",
                "undPesoTotal": "KGM",
                "transportista": {
                    "tipoDoc": "6",
                    "numDoc": "20609288737",
                    "rznSocial": "INVERSIONES Y SERVICIOS VELOX SAC",
                    "nroMtc": "0001",
                    "placa": "AMY829",
                    "choferTipoDoc": "1",
                    "choferDoc": "42895953"
                },
                "partida": {
                    "ubigeo": "080101",
                    "direccion": "AV LA  CULTURA URB 3 DE   MAYO B-8 SAN JERONIMO CUSCO"
                },
                "llegada": {
                    "ubigeo": "150103",
                    "direccion": "LIMA "
                }
            },
            "details": [
                {
                "codigo": "100",
                "descripcion": "CILINDROS DE NITROGENO SERIE:21217126-20235016-5438012-20232155-21217143-21218081-21217138-21218136-21217141<br />\n",
                "unidad": "NIU",
                "cantidad": "9.00"
                },
                {
                "codigo": "14",
                "descripcion": "CILINDROS DE ACETILENO SERIE:315111-219069067-219069202-2210709-683521-292253-219069063-58164-2123-219069350-223241-2210432-219069258<br />\n",
                "unidad": "NIU",
                "cantidad": "13.00"
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
