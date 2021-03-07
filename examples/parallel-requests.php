<?php

use GuzzleHttp\Promise\Utils;
use Instagram\SDK\Instagram;

require_once __DIR__ . '/../vendor/autoload.php';

$instagram = Instagram::builder()->build();
$instagram->login('INSERT_USERNAME', 'INSERT_PASSWORD');

$response = $instagram->inbox();

// Retrieve the available threads
$threads = $response->getInbox()->getThreads();

$promises = [];

foreach ($threads as $thread) {
    // Queue the requests
    $promises[] = $thread->wholePromise();
}

// Parallel requests, retrieve all threads
$threads = Utils::unwrap($promises);

// Output the threads
var_dump($threads);