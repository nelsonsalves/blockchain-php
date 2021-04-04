<?php

/**
 *
 */
class Transaction {

  /**
   *
   */
  public $fromAddress;
  /**
   *
   */
  public $toAddress;
  /**
   *
   */
  public $amount;

  /**
   *
   */
  public function __construct($fromAddress, $toAddress, $amount) {
    $this->fromAddress = $fromAddress;
    $this->toAddress = $toAddress;
    $this->amount = $amount;
    $this->signature = '';
  }

  /**
   *
   */
  public function calculateHash() {
    return hash('sha256', $this->fromAddress . $this->toAddress . $this->amount);
  }

  /**
   *
   */
  public function signTransaction($signingKey) {

    if ($signingKey->publicKey !== $this->fromAddress) {
      throw new Exception('You cannot sign transactions from other wallets');
    }

    $hashTx = $this->calculateHash();
    openssl_sign($hashTx, $signature, $signingKey->privateKey);
    $this->signature = $signature;
    $this->publicKey = $signingKey->publicKey;

  }

  /**
   *
   */
  public function isValid() {
    if ($this->fromAddress === NULL) {
      return TRUE;
    }
    if (!$this->signature) {
      throw new Exception('No transaction found in this transaction');
    }

    return openssl_verify($this->calculateHash(), $this->signature, $this->publicKey);
  }

}
