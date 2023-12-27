<?php

namespace PuyuPe\Qillqay\Tests;

use PuyuPe\Qillqay\Generate;

use PHPUnit\Framework\TestCase;

class GuiaRemisionTest extends TestCase
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
            "ruc": "20490793624",
            "razonSocial": "INVERSIONES AUTOVET S.R.L.",
            "nombreComercial": "INVERSIONES AUTOVET S.R.L.",
            "address": {
            "ubigueo": "030101",
            "codigoPais": "PE",
            "departamento": "Apurímac",
            "provincia": "Abancay",
            "distrito": "Abancay",
            "urbanizacion": null,
            "direccion": "AV. Canadá A-01 INT. Las Amerícas - Abancay - Apurímac",
            "codLocal": "0000"
            },
            "email": null,
            "telephone": null
            },
            "tipoDoc": "09",
            "serie": "T001",
            "correlativo": "328",
            "fechaEmision": "2023-12-22",
            "observation": "PARA LA UNIDAD VEHICULAR TOYOTA HILUX DE PLACA: EGT-248 DEL C.S. PROGRESO",
            "destinatario": {
            "tipoDoc": "6",
            "numDoc": "20491240238",
            "rznSocial": "RED DE SALUD GRAU"
            },
            "envio": {
            "modTraslado": "02",
            "codTraslado": "01",
            "desTraslado": "VENTA",
            "fecTraslado": "2023-12-22",
            "indTransbordo": 0,
            "pesoTotal": "28.70",
            "undPesoTotal": "KGM",
            "choferes": [
            {
            "tipo": "Principal",
            "tipoDoc": "1",
            "nroDoc": "70760896",
            "nombres": "JONATHAN",
            "apellidos": "HUAMAN CCOYURI",
            "licencia": "T70760896"
            }
            ],
            "vehiculo": {
            "placa": "EGT248",
            "codEmisor": "string",
            "nroAutorizacion": null
            },
            "partida": {
            "ubigeo": "030101",
            "direccion": "AV. CANADA A-01 INT, LAS AMERICAS"
            },
            "llegada": {
            "ubigeo": "030701",
            "direccion": "AV. RENZO MICHELLY S/N CHUQUIBAMBILLA GRAU"
            }
            },
            "details": [
            {
            "codigo": "3",
            "descripcion": "ACEITE&nbsp;LUBRICANTE&nbsp;SAE&nbsp;15W-40°&nbsp;PARA&nbsp;MOTOR&nbsp;PETROLERO&nbsp;<br>X&nbsp;1/4&nbsp;gal&nbsp;-&nbsp;CHEVRON",
            "unidad": "NIU",
            "cantidad": "7.00"
            },
            {
            "codigo": "244",
            "descripcion": "ACEITE&nbsp;LUBRICANTE&nbsp;SAE&nbsp;80W-90°&nbsp;X&nbsp;1/4&nbsp;GAL&nbsp;-&nbsp;CHEVRON",
            "unidad": "NIU",
            "cantidad": "3.00"
            },
            {
            "codigo": "36",
            "descripcion": "FILTRO&nbsp;DE&nbsp;ACEITE&nbsp;COD.&nbsp;REF.&nbsp;90915YZZD2&nbsp;-&nbsp;TOYOTA",
            "unidad": "NIU",
            "cantidad": "1.00"
            },
            {
            "codigo": "381",
            "descripcion": "FILTRO&nbsp;DE&nbsp;AIRE&nbsp;COD.&nbsp;REF&nbsp;178010R010&nbsp;-TOYOTA",
            "unidad": "NIU",
            "cantidad": "1.00"
            },
            {
            "codigo": "38",
            "descripcion": "FILTRO&nbsp;DE&nbsp;PETROLEO&nbsp;COD.&nbsp;REF.&nbsp;&nbsp;233900L041&nbsp;-&nbsp;TOYOTA",
            "unidad": "NIU",
            "cantidad": "2.00"
            },
            {
            "codigo": "540",
            "descripcion": "JUEGO&nbsp;DE&nbsp;PASTILLAS&nbsp;DE&nbsp;FRENO&nbsp;PARA&nbsp;TOYOTA&nbsp;COD&nbsp;REF&nbsp;0446502061&nbsp;-&nbsp;FRENOSA<br>ADQUISICION&nbsp;DE&nbsp;PASTILLAS&nbsp;DE&nbsp;FRENO&nbsp;PARA&nbsp;TOYOTA,&nbsp;INCLUYE&nbsp;EL&nbsp;CAMBIO&nbsp;DE&nbsp;LAS&nbsp;PASTILLAS<br>EN&nbsp;LA&nbsp;UNIDAD&nbsp;VEHICULAR.",
            "unidad": "NIU",
            "cantidad": "1.00"
            },
            {
            "codigo": "696",
            "descripcion": "PLUMILLA&nbsp;LIMPIAPARABRISAS&nbsp;PARA&nbsp;TOYOTA&nbsp;COD&nbsp;REF&nbsp;8522226120&nbsp;-&nbsp;HELLA<br>ADQUISICION&nbsp;DE&nbsp;PLUMILLA&nbsp;LIMPIAPARABRISAS&nbsp;PARA&nbsp;TOYOTA,&nbsp;INCLUYE&nbsp;EL&nbsp;CAMBIO&nbsp;DE&nbsp;LAS&nbsp;<br>PLUMILLAS&nbsp;EN&nbsp;LA&nbsp;UNIDAD&nbsp;VEHICULAR.",
            "unidad": "NIU",
            "cantidad": "2.00"
            },
            {
            "codigo": "49",
            "descripcion": "SISTEMA&nbsp;DIFERENCIAL&nbsp;POSTERIOR&nbsp;COMPLETO&nbsp;PARA&nbsp;TOYOTA&nbsp;COD&nbsp;REF&nbsp;REF&nbsp;411103D261&nbsp;-&nbsp;MG<br>ADQUISCION&nbsp;E&nbsp;INSTALACION&nbsp;DE&nbsp;CONJUNTO&nbsp;DIFERENCIAL&nbsp;POSTERIOR,&nbsp;QUE&nbsp;INCLUYE&nbsp;LOS&nbsp;<br>SIGUIENTES&nbsp;REPUESTOS:<br>-&nbsp;01&nbsp;CONJUNTO&nbsp;DE&nbsp;DISCOS&nbsp;DE&nbsp;BLOCAJE<br>-&nbsp;01&nbsp;CASTILLO&nbsp;DE&nbsp;CORONA<br>-&nbsp;01&nbsp;ESPACIADOR<br>-&nbsp;01&nbsp;EMPAQUE&nbsp;PARA&nbsp;CORONA<br>-&nbsp;02&nbsp;RODAJES&nbsp;LATERALES<br>-&nbsp;01&nbsp;RODAJE&nbsp;GRANDE&nbsp;DE&nbsp;PIÑON&nbsp;DE&nbsp;ATAQUE<br>-&nbsp;01&nbsp;RODAJE&nbsp;PEQUEÑO&nbsp;DE&nbsp;PIÑON&nbsp;DE&nbsp;ATAQUE<br>-&nbsp;01&nbsp;RETEN&nbsp;DE&nbsp;CORONA<br>-&nbsp;03&nbsp;ARANDELAS&nbsp;DE&nbsp;ALUMINIO<br>-&nbsp;01&nbsp;TAPON&nbsp;PERNO&nbsp;DE&nbsp;CORONA",
            "unidad": "NIU",
            "cantidad": "1.00"
            },
            {
            "codigo": "510",
            "descripcion": "SOPORTE&nbsp;CENTRAL&nbsp;DE&nbsp;CARDAN&nbsp;PARA&nbsp;RODAMIENTO&nbsp;DE&nbsp;BOLA&nbsp;PARA&nbsp;VOLKSWAGEN&nbsp;COD&nbsp;REF&nbsp;<br>TMJ/521117&nbsp;-&nbsp;YOKOZUNA<br>SOPORTE&nbsp;CENTRAL&nbsp;DE&nbsp;CARDAN.",
            "unidad": "NIU",
            "cantidad": "1.00"
            },
            {
            "codigo": "8",
            "descripcion": "TAPON&nbsp;DE&nbsp;CARTER&nbsp;PARA&nbsp;TOYOTA&nbsp;COD.&nbsp;REF.&nbsp;90341&nbsp;12012&nbsp;-&nbsp;TOYOTA<br>SELLO&nbsp;EMPAQUE&nbsp;DE&nbsp;TAPON&nbsp;DE&nbsp;CARTER",
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
            "is_production": true
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
