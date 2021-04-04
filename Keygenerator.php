<?php

/**
 *
 */
class Keygenerator {

  /**
   *
   */
  public function __construct() {
    $configArgs = ['config' => 'D:/xampp/php/extras/ssl/openssl.cnf'];

    $this->privateKeyResource = openssl_pkey_new($configArgs);
    $this->privateKey = openssl_pkey_get_private($this->privateKeyResource);
    $this->publicKey = openssl_pkey_get_details($this->privateKeyResource)['key'];
  }

}



/*
// WRITE PUBLIC AND PRIVATE KEY.
$configArgs = ['config' => 'D:/xampp/php/extras/ssl/openssl.cnf'];

// Generate new instance key.
$privateKeyResource = openssl_pkey_new($configArgs);
// Export private key to location.
openssl_pkey_export_to_file($privateKeyResource, 'D:\xampp\htdocs\test\myNewPrivateKey.key', NULL, $configArgs);
// Export private key to location.
$privateKeyDetailsArray = openssl_pkey_get_details($privateKeyResource);
file_put_contents('D:\xampp\htdocs\test\myNewPublicKey.key', $privateKeyDetailsArray['key']);
// Free key.
openssl_free_key($privateKeyResource);
 */
