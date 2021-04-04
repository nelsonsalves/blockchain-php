<?php

/**
 *
 */
class Block {

  /**
   *
   */
  public $timestamp;
  /**
   *
   */
  public $transactions;
  /**
   *
   */
  public $previousHash;
  /**
   *
   */
  public $nonce;

  /**
   *
   */
  public function __construct($timestamp, $transactions, $previousHash = '') {
    $this->timestamp = $timestamp;
    $this->transactions = $transactions;
    $this->previousHash = $previousHash;
    $this->hash = $this->calculateHash();
    $this->nonce = 0;
  }

  /**
   *
   */
  public function calculateHash() {
    return hash('sha256', $this->previousHash . $this->timestamp . json_encode($this->transactions) . $this->nonce);
  }

  /**
   *
   */
  public function mineBlock($difficulty) {
    while (substr($this->hash, 0, $difficulty) !== str_pad('', $difficulty, '0')) {
      $this->nonce++;
      $this->hash = $this->calculateHash();
    }
    echo 'BLOCK MINED: ' . $this->hash . '</br>';
  }

  /**
   *
   */
  public function hasValidTransactions() {
    for ($i = 1; $i <= count($this->transactions); $i++) {
      if (!$this->transactions[$i - 1]->isValid()) {
        return FALSE;
      }
    }
    return TRUE;
  }

}
