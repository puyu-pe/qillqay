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
- Binario wkhtmltopdf

## Instalación

- Agregar la siguiente linea a composer.json en el proyecto a utilizar:

```
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/puyu-pe/nexus-doc-gen",
            "options": {
                "github-token": "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"
            }
        }
    ],
...
"require": {
        "puyu-pe/nexus-doc-gen": "^0.1.0",
}
``` 
- Ejecutar:
```
composer install
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
- En caso de tenerlo como array de objetos debe ser un arreglod e tipo objeto.
- Adicionar un campo params al arreglo, debe contener la siguiente estructura:
```json
'{
  "system": {
    "hash": "m70vBMajaapHr5ByjkwEER8tCjc=", //Codigo hash del comprobante 
    "background": "#000000", //Color de encabezados
    "anulled": false, //Estado del comprobante
    "is_production": true //Si es en modo producción
  },
  "user": {
    //Pie de página del comprobante
    "footer": "MUCHAS GRACIAS POR SU PREFERENCIA</br></br><div>Consulte el documento electrónico en :</br>http://localhost:8080/10123456789</div><br>",
    //Datos extra requeridos para el formato a4 greenter
    "extras": [
      {
        "name": "FORMA DE PAGO",
        "value": "Contado PEN 36.00"
      },
      {
        "name": "CAJERO",
        "value": "nombre"
      },
      {
        "name": "OBSERVACIÓN",
        "value": ""
      }
    ],
    //Logotipo en formato base64
    "logo": "data:image/png;base64,[codigo]"
  },
  "documentFooter": null //Pie de página o mensaje final del cliente en el comprobante
}'
```

