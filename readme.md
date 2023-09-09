# Libreria para generar representación de CPE

** LIBRERIA EN PRUEBAS **

Libreria para generar documentos PDF en formato A4:
- Facturas
- Boletas
- Notas de Crédito
- Guias de remisión

# Utilización

## Requerimientos

- PHP 7.4
- binario wkhtmltopdf

## Instalación

- Agregar la siguiente linea a composer.json en el proyecto a utilizar:

```
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/puyu-pe/nexus-doc-gen"
    }
]
...
"require": {
    "puyu-pe/nexus-doc-gen": "dev-main"
}
``` 
- Ejecutar:
```
composer update
```