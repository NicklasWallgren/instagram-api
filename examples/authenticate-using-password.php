<?php

use Instagram\SDK\Instagram;

require_once __DIR__ . '/../vendor/autoload.php';

$instagram = Instagram::builder()->build();
$response = $instagram->login('INSERT_USERNAME', 'INSERT_PASSWORD');

// Output authenticated user information
var_dump($response->getSession()->getUser());