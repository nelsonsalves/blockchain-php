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
  }

}
