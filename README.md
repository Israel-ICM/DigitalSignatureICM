# DigitalSignatureICM - Firma electrónica

Herramienta para generar llaves pública y privada con **PHP** utilizando **OpenSSL**.
Firma cadenas, algo que podria ayudarte si necesitas firmar archivos **XML**. Éste es solo un pequeño ejemplo para los que necesiten un código
pequeño y limpio sobre el que trabajar.

## Comenzando 🚀

Primeramente te aviso que el proyecto fué desarrollado con **PHP7** pero evité utilizar sintaxis de esta version por lo cuál
el proyecto se puede utilizar en **PHP>=5.5**
También utilicé **Xampp** en la **version 7.2.5** ten muy en cuenta esto porque necesitarás el path del archivo **openssl.cnf**
que en mi caso se encuentra en:
```
C:\xampp\php\extras\openssl\openssl.cnf
```

## Ejecutando las pruebas ⚙️
Como verás a continuación el funcionamiento es bastante simple:

```php
<?php
require_once ('DigitalSignatureICM.php');

$keyNamePrivate = 'myKeyPrivate.pem';
$keyNamePublic = 'myKeyPublic.pem';

$digitalSignatureICM = new DigitalSignatureICM();
$config = $digitalSignatureICM->getConfigDefault(); // OJO que para este ejemplo estoy utilizando una configuración que tengo instanciada
por default si necesitas agregar otra configuración puedes enviársela como parámetro en el constructor

// Generamos las llaves privada y pública
$digitalSignatureICM->generateKeys($config, $keyNamePrivate, $keyNamePublic);
// Firmamos un texto de prueba
$signature = $digitalSignatureICM->sign('This text will be signed !!!', $keyNamePrivate);
// Verificamos si existe algún cambio en la firma o texto de prueba ingresado
$verify = $digitalSignatureICM->verifySignature('This text will be signed !!!', $signature, $keyNamePublic);
if ($verify)
    echo 'La firma es válida !!!';
else
    echo 'La firma es inválida y es posible que algún dato haya sido alterado !!!';
```

Puedes ejecutar el archivo **example.php** para un primer vistazo del funcionamiento
```bash
php example.php
```

## Software utilizado 🛠️

* [Xampp](https://www.apachefriends.org/es/download.html)

## Autores ✒️

_Por el momento soy el único contribuidor de éste proyecto_

* **Israel Condori Mañueco** - *Trabajo Inicial* - [Israel-ICM](https://www.youtube.com/channel/UCGmN_BvrLlCeSREmZ0tykSw)

## Licencia 📄

Este proyecto está bajo la Licencia (MIT) - mira el archivo [LICENSE.md](LICENSE.md) para más detalles


---
⌨️ Con ❤️ por [Israel-ICM](https://github.com/Israel-ICM) 😊 y que viva [Apple](https://www.apple.com/) XDXDXD
