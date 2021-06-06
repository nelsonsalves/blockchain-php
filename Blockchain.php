<?php

include 'Block.php';
include 'Transaction.php';
/**
 *
 */
class Blockchain {

  /**
   *
   */
  public function __construct() {
    $this->chain = [$this->createGenesisBlock()];
    $this->difficulty = 2;
    $this->pendingTransactions = [];
    $this->miningReward = 100;

  }

  /**
   *
   */
  public function createGenesisBlock() {
    return new Block('01/01/2020', [new Transaction('address1', 'address3', '100')], 'initial hash');
  }

  /**
   *
   */
  public function getLatestBlock() {
    return $this->chain[count($this->chain) - 1];
  }

  /**
   *
   */
  public function miningPendingTransactions($miningRewardAddress) {
    $block = new Block('01/01/2021', $this->pendingTransactions);
    $block->previousHash = $this->getLatestBlock()->hash;
    $block->mineBlock($this->difficulty);
    echo 'block succefully mined! </br>';
    array_push($this->chain, $block);
    $this->pendingTransactions = [
      new Transaction(NULL, $miningRewardAddress, $this->miningReward),
    ];
  }

  /**
   *
   */
  public function addTransaction($transaction) {
    if (!$transaction->fromAddress || !$transaction->toAddress) {
      throw new Exception('Transaction must include from and to address');
    }

    if (!$transaction->isValid()) {
      throw new Exception('Cannot add invalid transaction');
    }
    array_push($this->pendingTransactions, $transaction);
  }

  /**
   *
   */
  public function getBalanceOfAddress($address) {
    $balance = 0;
    foreach ($this->chain as $block) {
      foreach ($block->transactions as $trans) {
        if ($trans->fromAddress === $address) {
          $balance -= $trans->amount;
        }
        if ($trans->toAddress === $address) {
          $balance += $trans->amount;
        }
      }
    }
    echo 'the balance of the address ' . $address . ' is: ' . $balance . '</br>';
  }

  /**
   *
   */
  public function isChainValid() {
    for ($i = 1; $i <= count($this->chain) - 1; $i++) {
      $currentBlock = $this->chain[$i];
      $previousBlock = $this->chain[$i - 1];

      if (!$currentBlock->hasValidTransactions()) {
        echo 'false transaction </br>';
        return;
      }

      if ($currentBlock->hash !== $currentBlock->calculateHash()) {
        echo 'hash has been tampered </br>';
        return;
      }

      if ($currentBlock->previousHash !== $previousBlock->hash) {
        echo 'block info has been tampered </br>';
        return;
      }

      echo 'true </br>';
    }
  }

}
