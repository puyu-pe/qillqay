# PUYU.PE QILLQAY
## Libreria para generar representación de CPE

** LIBRERIA EN PRUEBAS **

Libreria para generar documentos en formatos A4 y ticket en PDF y HTML:

Documentos electrónicos:
- Facturas
- Boletas
- Notas de Crédito
- Guias de remisión (solo a4)

Documentos personalizados (desde el mismo formato de objeto y/o html):
- Requiere datos adicionales (ver generación de objeto)

# Utilización

## Requerimientos
- PHP 7.4
- Binario wkhtmltopdf 0.12.6 (mínimo) https://wkhtmltopdf.org/

## Instalación
- Ejecutar el comando:

```
composer require puyu-pe/qillqay
```
## Utilización

- Incluir la libreria
```
use PuyuPe\Qillqay\Generate;
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
    'tipoDocNombre' => '', // REQUERIDO SI tipoDoc = 00 
    'codLocal' => '0000',
    'serie' => 'B001',
    'correlativo' => '25735',
    'fechaEmision' => '2023-09-19 09:12:58',
    'fechaVencimiento' => '2023-09-19',
    'tipoMoneda' => 'PEN',
    'mtoOperGravadas' => '0.00',
    'mtoOperExoneradas' => '6.00',
    'mtoOperInafectas' => '0.00',
    'mtoIGV' => '0.00',
    'totalImpuestos' => '0.00',
    'valorVenta' => '6.00',
    'subTotal' => '6.00',
    'mtoImpVenta' => '6.00',
    'formaPago' => (object) [
        'moneda' => 'PEN',
        'tipo' => 'Contado',
        'monto' => '6.0000',
    ],
    'cuotas' => [],
    'client' => (object) [
        'tipoDoc' => '1',
        'numDoc' => '70430738',
        'rznSocial' => 'LUIS ALFREDO HUAMANI QUISPE',
        'address' => (object) [
            'direccion' => null
        ]
    ],
    'cashier' => (object) [
        'tipoDoc' => 1,
        'numDoc' => '-',
        'rznSocial' => 'ucaja'
    ],
    'detailsHeader' => //REQUERIDO SI tipoDoc = 00
        [ // ENCABEZADO A MOSTRAR => DATO EN details
            (object) [
             'title ' => 'CODIGO',
             'field' => 'codProducto',
             'align' => 'left' //Alineación de items, opcional, por defecto derecha (right)
             ],
            (object) [
             'title ' => 'UNIDAD',
             'field' => 'unidad'
             ],
            (object) [
             'title ' => 'DESCRIPCION',
             'field' => 'descripcion'
             ],
            (object) [
             'title ' => 'CANTIDAD',
             'field' => 'cantidad'
             ],
            (object) 
            [ 'title ' => 'PRECIO ,
            'field' UNITARIO' => 'mtoPrecioUnitario'
            ],
            (object) [
             'title ' => 'TOTAL',
             'field' => 'total'
             ],
        ],
    'details' => [ //DE ACUERDO A detailsHeader, si tipodoc = 00 incluir todos los mencionados en field
        (object) [
            'codProducto' => '1.3.23.14.1',
            'unidad' => 'NIU',
            'descripcion' => 'CONSTANCIA DE NOTAS POR SEMESTRE',
            'cantidad' => '1.00',
            'mtoValorUnitario' => '6.00',
            'mtoValorVenta' => '6.00',
            'mtoBaseIgv' => '6.00',
            'porcentajeIgv' => 0,
            'igv' => 0,
            'tipAfeIgv' => '20',
            'totalImpuestos' => 0,
            'mtoPrecioUnitario' => '6.00',
            'total' => '6.00' //REQUERIDO SI tipoDoc = 00
        ],
    ],
    'detailsSummary' => [ //REQUERIDO SI tipoDoc = 00
        (object) [ // TOTALES O RESUMEN A MOSTRAR
            'title' => 'TOTAL',
            'value' => '6.00',
            'colspan' => 2 //Requerido para formato ticket
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
    'params' => [VER CAMPO ADICIONAL]
];
```
- Adicionar un campo params al objeto, debe contener la siguiente estructura:
```
$data->params = (object) [
    'system' => (object) [
        'hash' => 'm70vBMajaapHr5ByjkwEER8tCjc=',
        'background' => '#000000',
        'appMessage' => 'Emitido desde YUBIZ.PUYU.PE', //Requerido en formato ticket
        'customCss' => '[CSS adicional para modificar estilos del documento, opcional]',
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
                'value' => '[Mensaje final u observación del documento, puede ser nulo]',
            ],
        ],
        'logo' => 'data:image/png;base64,[codigo]', 
    ],
    'stringQR' => '', //Cadena a generar codigo QR, requerido para CPE
    'documentFooter' => null,
];
```
- Se requieren los siguientes parámetros al momento de llamar a una de las funciones:

```
$data = Objeto de datos para generar el documento, para la función fromObject.
$html = Cadena html para generar el documento, para la función fromHtml.
$format = Formato de retorno del objeto (Opcional)
          [pdf : Valor por defecto, stream pdf, html: Cadena html, file : Archivo en disco temporal (en pruebas)]
$size = Tamaño del documento a generar (ticket, a4), solo para función fromHtml (Valor por defecto : a4).
$wkhtmlPath = Ruta del archivo binario o ejecutable, valor por defecto 'wkhtmltopdf'. (Opcional)
$env = Entorno de ejecución, solo usado para pruebas unitarias (Opcional, Valor por defecto run)
```
- Llamar a la función fromObject usando el siguiente codigo:
``` 
$data = [OBJETO DE DATOS]

return Generate::fromObject($data); //Stream de archivo pdf (tamaño segun parametro de objeto)
return Generate::fromObject($data, 'pdf', 'ruta/a/wkhtmltopdf'); //Stream de archivo pdf indicando la ruta del binario/ejecutable
$html = Generate::fromObject($data, 'html'); //Generar string formato html
$location = Generate::fromObject($data, 'file'); //Archivo temporal en pdf (En pruebas)
```
- Llamar a la función fromHtml (debe incluir el css):
``` 
$html = [cadena html a generar]

return Generate::fromHtml($html); //Stream de archivo pdf en tamaño a4
return Generate::fromHtml($html, 'pdf', 'ticket'); //Stream de archivo pdf en tamaño ticket
return Generate::fromHtml($html, 'pdf', 'a4', 'ruta/a/wkhtmltopdf'); //Stream de archivo pdf en tamaño a4 indicando la ruta del binario/ejecutable
```
Se genera un stream del archivo, asi que no es necesario agregar return o asignarlo a una variable