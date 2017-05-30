<?php

use NicklasW\Instagram\Client\Adapters\PromiseAdapter;
use NicklasW\Instagram\Instagram;

require_once __DIR__ . '/../vendor/autoload.php';

// Initialize the Instagram library
$instagram = new Instagram(null, null, new PromiseAdapter());

// Authenticate using username and password
$instagram->login('INSERT_USERNAME', 'INSERT_PASSWORD')->wait();

// Retrieve the inbox envelope
$message = $instagram->inbox()->wait();

// Retrieve the inbox instance from the inbox message
$inbox = $message->getInbox();

// Retrieve the available threads
$threads = $inbox->getThreads();

$promises = [];

foreach ($threads as $thread) {
    // Queue the requests
    $promises[] = $thread->whole();
}

// Parallel requests, retrieve all threads
\GuzzleHttp\Promise\unwrap($promises);

// Output the threads
var_dump($threads);