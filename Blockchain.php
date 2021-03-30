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

  /**
   * Public function addBlock($newBlock) {
   * $newBlock->previousHash = $this->getLatestBlock()->hash;
   * $newBlock->hash = $newBlock->calculateHash();
   * $newBlock->mineBlock($this->difficulty);
   * array_push($this->chain, $newBlock);
   * return $this->chain[count($this->chain) - 1];
   * } .
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
  public function createTransaction($transaction) {
    array_push($this->pendingTransactions, $transaction);
  }

  /**
   *
   */
  public function getBalanceOfAddress($address) {
    $balance = 0;
    foreach ($this->chain as $block) {
      /*       var_dump($block);
      die; */
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
    // Return $balance;.
  }

  /**
   *
   */
  public function isChainValid() {
    for ($i = 1; $i <= count($this->chain) - 1; $i++) {
      $currentBlock = $this->chain[$i];
      $previousBlock = $this->chain[$i - 1];

      if ($currentBlock->hash !== $currentBlock->calculateHash()) {
        // Return FALSE;.
        echo 'false 1 </br>';
        return;
      }

      if ($currentBlock->previousHash !== $previousBlock->hash) {
        // Return FALSE;.
        echo 'false 2 </br>';
        return;
      }

      echo 'true </br>';
      // Return TRUE;.
    }
  }

}

$blockchain = new Blockchain();


/* echo 'mining block1 </br>';
$blockchain->addBlock(new Block('12345', json_encode(['ammount' => '100'])));
echo 'mining block2 </br>';
$blockchain->addBlock(new Block('12345', json_encode(['ammount' => '200'])));
echo 'mining block3 </br>';
$blockchain->addBlock(new Block('12345', json_encode(['ammount' => '-500']))); */


// Second logic block.
$blockchain->createTransaction(new Transaction('address1', 'address2', '100'));
$blockchain->createTransaction(new Transaction('address2', 'address1', '200'));
$blockchain->createTransaction(new Transaction('address1', 'address2', '500'));
$blockchain->miningPendingTransactions('miner-address');


$blockchain->getBalanceOfAddress('address1');
$blockchain->getBalanceOfAddress('address2');
$blockchain->getBalanceOfAddress('miner-address');



$blockchain->isChainValid();
// Echo serialize($blockchain->chain);.
echo "<pre>";
print_r($blockchain->chain);
echo "</pre>";

$blockchain->createTransaction(new Transaction('address1', 'address2', '100'));
$blockchain->createTransaction(new Transaction('address2', 'address1', '200'));
$blockchain->createTransaction(new Transaction('address1', 'address2', '500'));
$blockchain->miningPendingTransactions('miner-address');
$blockchain->getBalanceOfAddress('address1');
$blockchain->getBalanceOfAddress('address2');
$blockchain->getBalanceOfAddress('miner-address');


//$blockchain->chain[2]->data = 'este é que é o bloco 2'; //tampering 1
// $blockchain->chain[2]->hash = $blockchain->chain[2]->calculateHash(); //tampering 2
$blockchain->isChainValid();
// Echo serialize($blockchain->chain);.
echo "<pre>";
print_r($blockchain->chain);
echo "</pre>";
