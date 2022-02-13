# Lectura XlSX con php
## Preparacion
- 1: 1: Se utiliza la libreria phpSpreadsheet's: https://phpspreadsheet.readthedocs.io/en/latest/
-  2: para su instalacion de las dependencias utilize el siguiente comando(composer debe estar instalado)[Nota: en caso de haber un error en este paso revise el paso 3 para una posible solucion]: composer install
-  3: es posible que marque un error relacionado con ext-gd al ejecutar el paso 2, en ese caso es posible que necesite ir a c:/programFiles/php[...]/php.ini, y buscar ;extension=gd, si esta con ;, significa que esta comentado y debe cambiarse a extension=gd, una vez realizado esto ejecute el paso 2 una vez mas

## Uso
- Para su uso solo se necesario iniciar un puerto para php (como puede ser con xampp)
- se abre el archivo index.html en el navegador
- se selecciona un archivo .xslx en el formulario
- se envia el formulario
## Como se muestran los datos:
- los datos se muestran en una tabla de html
- Se muestran todas las hojas disponibles en la hoja de calculo
- Se muestran todas las columnas que tengan algun valor en el archivo