<?php

use NicklasW\Instagram\Client\Adapters\PromiseAdapter;
use NicklasW\Instagram\Instagram;

require_once __DIR__ . '/../vendor/autoload.php';

// Create the guzzle client
$client = new GuzzleHttp\Client(['proxy' => 'INSERT_PROXY']);

// Initialize the Instagram library, pass the client
$instagram = new Instagram($client);

// Authenticate using username and password
$envelope = $instagram->login('INSERT_USERNAME', 'INSERT_PASSWORD')->wait();

// Output the response
var_dump($envelope);

