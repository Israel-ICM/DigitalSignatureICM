<?php
/**
 * @author Israel-ICM
 * @date 2019-08-27
 * @version 1.0.0
 * @license MIT
 */
class DigitalSignatureICM {
    /**
     * Configurations
     * @var array
     */
    private $_config = [
        'config' => 'C:\xampp\php\extras\openssl\openssl.cnf', // This route is necessary if you work with XAMPP
        'private_key_bits' => 2048,
        'private_key_type' => OPENSSL_KEYTYPE_RSA
    ];

    /**
     * DigitalSignatureICM constructor.
     * @param array $config
     */
    public function __construct($config = null) {
        $this->_config = empty($config) ? $this->_config : $config;
    }

    /**
     * @return array
     */
    public function getConfigDefault() {
        return $this->_config;
    }

    /**
     * @param array $config
     * @param string $keyNamePrivate
     * @param string $keyNamePublic
     * @example generateKeys($config, 'myKeyPrivate.pem', 'myKeyPublic.pem')
     */
    public function generateKeys($config, $keyNamePrivate, $keyNamePublic) {
        $resourceNewKeyPair = openssl_pkey_new($config);
        if (!$resourceNewKeyPair) {
            echo 'Check the config parameter: ';
            echo openssl_error_string();
            exit;
        }

        $details = openssl_pkey_get_details($resourceNewKeyPair);
        $publicKeyPem = $details['key'];

        if (!openssl_pkey_export($resourceNewKeyPair, $privateKeyPem, NULL, $config)) {
            echo openssl_error_string();
            exit;
        }
        file_put_contents($keyNamePrivate, $privateKeyPem);
        file_put_contents($keyNamePublic, $publicKeyPem);
    }

    /**
     * @param string $data Text to sign
     * @param string $fileNamePrivateKeyPem Private key route
     * @return mixed
     */
    public function sign($data, $fileNamePrivateKeyPem) {
        // openssl_get_privatekey('file://' . $fileNamePrivateKeyPem, 'myPassword');
        $privateKeyPem = file_get_contents($fileNamePrivateKeyPem);

        $resourcePrivateKey = openssl_get_privatekey($privateKeyPem);
        if (!openssl_sign($data, $firma, $resourcePrivateKey, OPENSSL_ALGO_SHA256)) {
            echo openssl_error_string();
            exit;
        }
        file_put_contents('signature.dat', $firma); // save signature to disk
        return $firma;
    }

    /**
     * @param string $data
     * @param string $signature
     * @param string $fileNamePublicKeyPem Public key route
     * @return bool
     */
    public function verifySignature($data, $signature, $fileNamePublicKeyPem) {
        $publicKeyPem = file_get_contents($fileNamePublicKeyPem);
        // verify signature
        if (openssl_verify($data, $signature, $publicKeyPem, 'sha256WithRSAEncryption') === 1)
            return true;
        else
            return false;
    }
}
