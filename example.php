<?php
/**
 * @author Israel-ICM
 * @date 2019-08-27
 */

require_once ('DigitalSignatureICM.php');

$keyNamePrivate = 'myKeyPrivate.pem';
$keyNamePublic = 'myKeyPublic.pem';

$digitalSignatureICM = new DigitalSignatureICM();
$config = $digitalSignatureICM->getConfigDefault();

// We generate the public and private keys
$digitalSignatureICM->generateKeys($config, $keyNamePrivate, $keyNamePublic);
// We sign a test text
$signature = $digitalSignatureICM->sign('This text will be signed !!!', $keyNamePrivate);
// We verify with the public key if the signature is correct
$verify = $digitalSignatureICM->verifySignature('This text will be signed !!!', $signature, $keyNamePublic);
if ($verify)
    echo 'The signature is valid. The data is reliable !!!';
else
    echo 'The signature is invalid it is possible that the data has been altered !!!';


// This is just a simple signature example. hope it has been helpful