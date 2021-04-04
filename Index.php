<?php

/**
 * @file
 * @file
 * @file
 * .*/

include 'Blockchain.php';
include 'Keygenerator.php';

// Initialize blockchain.
$blockchain = new Blockchain();
$key = new Keygenerator();
$wallet = $key->publicKey;


// Create transactions.
$tx1 = new Transaction($wallet, 'destination wallet', '100');
$tx1->signTransaction($key);
$blockchain->addTransaction($tx1);

$tx2 = new Transaction($wallet, 'miner-address', '200');
$tx2->signTransaction($key);
$blockchain->addTransaction($tx2);


// Start mining.
$blockchain->miningPendingTransactions('miner-address');

//Tampering with blockchain.
//$blockchain->chain[1]->hash = 'asdasds';
//$blockchain->chain[1]->transactions[0]->amount = 1;


// Check balance of wallet.
$blockchain->getBalanceOfAddress($wallet);
$blockchain->getBalanceOfAddress('miner-address');

// Check integrity of blockchain.
echo 'IS THE CHAIN VALID?: ';
$blockchain->isChainValid();

// Display blockchain.
echo "<pre>";
print_r($blockchain->chain);
echo "</pre>";


// First logic block.
/* echo 'mining block1 </br>';
$blockchain->addBlock(new Block('12345', json_encode(['ammount' => '100'])));
echo 'mining block2 </br>';
$blockchain->addBlock(new Block('12345', json_encode(['ammount' => '200'])));
echo 'mining block3 </br>';
$blockchain->addBlock(new Block('12345', json_encode(['ammount' => '-500']))); */


// Second logic block.
/* $blockchain->addTransaction(new Transaction('address1', 'address2', '100'));
$blockchain->addTransaction(new Transaction('address2', 'address1', '200'));
$blockchain->addTransaction(new Transaction('address1', 'address2', '500'));
$blockchain->miningPendingTransactions('miner-address'); */


/* $blockchain->getBalanceOfAddress($wallet);
$blockchain->getBalanceOfAddress('address2');
$blockchain->getBalanceOfAddress('miner-address'); */


/* echo 'IS THE CHAIN VALID?: ';
$blockchain->isChainValid(); */
// Echo serialize($blockchain->chain);.
/* echo "<pre>";
print_r($blockchain->chain);
echo "</pre>"; */

/* $blockchain->addTransaction(new Transaction('address1', 'address2', '100'));
$blockchain->addTransaction(new Transaction('address2', 'address1', '200'));
$blockchain->addTransaction(new Transaction('address1', 'address2', '500'));
$blockchain->miningPendingTransactions('miner-address');
$blockchain->getBalanceOfAddress('address1');
$blockchain->getBalanceOfAddress('address2');
$blockchain->getBalanceOfAddress('miner-address'); */


// $blockchain->chain[2]->data = 'este é que é o bloco 2'; //tampering 1
// $blockchain->chain[2]->hash = $blockchain->chain[2]->calculateHash(); //tampering 2
// $blockchain->isChainValid();
// Echo serialize($blockchain->chain);.
// echo "<pre>";
// print_r($blockchain->chain);
// echo "</pre>";
