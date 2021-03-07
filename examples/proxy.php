<?php

use Instagram\SDK\Client\Adapters\PromiseAdapter;
use Instagram\SDK\Instagram;

require_once __DIR__ . '/../vendor/autoload.php';

$instagram = Instagram::builder()->setProxyUri('INSERT_PROXY')->build();
$response = $instagram->login('INSERT_USERNAME', 'INSERT_PASSWORD');

// Output the response
var_dump($response);
