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
