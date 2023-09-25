# Libreria para generar representación de CPE

** LIBRERIA EN PRUEBAS **

Libreria para generar documentos en formatos A4 y ticket en PDF y HTML:
- Facturas
- Boletas
- Notas de Crédito
- Guias de remisión *

* Guias de remisión solo permite formato A4

# Utilización

## Requerimientos

- PHP 7.4
- Binario wkhtmltopdf 0.12.6 (mínimo)

## Instalación

- Ejecutar el comando:

```
composer require puyu-pe/nexus-doc-gen
```

## Utilización

- Incluir la libreria
```
use PuyuPe\NexusPdf\PdfGenerator;
```
- Generar el objeto $data, el cual es el objeto $invoice que se usa para enviar a nexus (https://github.com/puyu-pe/nexus/blob/develop/docs/api.md)
- Se puede usar el comando json_encode en caso de tener el json en una variable de tipo string 
```
$data = json_decode([JSON]) 
```
- Caso contrario generar el objeto:

```
$data = (object) [
    'company' => (object) [
        'ruc' => '20527056579',
        'razonSocial' => 'NOMBRE DE LA EMPRESA',
        'nombreComercial' => null,
        'address' => (object) [
            'ubigueo' => '030109',
            'codigoPais' => 'PE',
            'departamento' => 'Apurímac',
            'provincia' => 'Abancay',
            'distrito' => 'Abancay',
            'urbanizacion' => null,
            'direccion' => 'Av. Garcilazo de la Vega S/N',
            'codLocal' => '0000',
        ],
        'email' => null,
        'telephone' => '083-321965',
    ],
    'tipoOperacion' => '0101',
    'formato' => 'ticket',
    'tipoDoc' => '03',
    'codLocal' => '0000',
    'serie' => 'B001',
    'correlativo' => '25735',
    'fechaEmision' => '2023-09-19 09:12:58',
    'fechaVencimiento' => '2023-09-19',
    'tipoMoneda' => 'PEN',
    'mtoOperGravadas' => '0.0000',
    'mtoOperExoneradas' => '6.0000',
    'mtoOperInafectas' => '0.0000',
    'mtoIGV' => '0.0000',
    'totalImpuestos' => '0.0000',
    'valorVenta' => '6.0000',
    'subTotal' => '6.0000',
    'mtoImpVenta' => '6.0000',
    'formaPago' => (object) [
        'moneda' => 'PEN',
        'tipo' => 'Contado',
        'monto' => '6.000000',
    ],
    'cuotas' => [],
    'client' => (object) [
        'tipoDoc' => '1',
        'numDoc' => '70430738',
        'rznSocial' => 'LUIS ALFREDO HUAMANI QUISPE',
        'address' => (object) [
            'ubigueo' => '-',
            'direccion' => null,
        ],
        'email' => 'huamaniquispeluisalberto@gmail.com',
        'telephone' => null,
    ],
    'cashier' => (object) [
        'tipoDoc' => 1,
        'numDoc' => '-',
        'rznSocial' => 'ucaja',
    ],
    'details' => [
        (object) [
            'codProducto' => '1.3.23.14.1',
            'unidad' => 'NIU',
            'descripcion' => 'CONSTANCIA DE NOTAS POR SEMESTRE',
            'cantidad' => '1.0000',
            'mtoValorUnitario' => '6.0000',
            'mtoValorVenta' => '6.0000',
            'mtoBaseIgv' => '6.0000',
            'porcentajeIgv' => 0,
            'igv' => 0,
            'tipAfeIgv' => '20',
            'totalImpuestos' => 0,
            'mtoPrecioUnitario' => '6.0000',
        ],
    ],
    'legends' => [
        (object) [
            'code' => '1000',
            'value' => 'SEIS  CON 00/100 SOLES.',
        ],
    ],
    'observation' => null,
    'documentFooter' => null,
];


```

- Adicionar un campo params al objeto, debe contener la siguiente estructura:
```
$data->params = (object) [
    'system' => (object) [
        'hash' => 'm70vBMajaapHr5ByjkwEER8tCjc=',
        'background' => '#000000',
        'anulled' => false,
        'is_production' => true,
    ],
    'user' => (object) [
        'footer' => 'MUCHAS GRACIAS POR SU PREFERENCIA</br></br><div>Consulte el documento electrónico en :</br>http://localhost:8080/10123456789</div><br>',
        'extras' => [
            (object) [
                'name' => 'FORMA DE PAGO',
                'value' => 'Contado PEN 36.00',
            ],
            (object) [
                'name' => 'CAJERO',
                'value' => 'nombre',
            ],
            (object) [
                'name' => 'OBSERVACIÓN',
                'value' => '',
            ],
        ],
        'logo' => 'data:image/png;base64,[codigo]', 
    ],
    'documentFooter' => null,
];
```
- Llamar a la función generatePdf usando el siguiente codigo:
``` 
$wkhtmlPath = ''; //RUTA DEL BINARIO WKHTMLTOPDF, REQUERIDO SI SE QUIERE EN FORMATO PDF O ARCHIVO
$formato = 'pdf'; //pdf, html

PdfGenerator::generatePdf($data, $wkhtmlPath, $formato);
```

Se genera un stream del archivo, asi que no es necesario agregar return o asignarlo a una variable