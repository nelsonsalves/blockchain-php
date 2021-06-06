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
