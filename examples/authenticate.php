<?php

use Instagram\SDK\Instagram;

require_once __DIR__ . '/../vendor/autoload.php';

// Initialize the Instagram library
$instagram = new Instagram();

// Authenticate using username and password
$envelope = $instagram->login('INSERT_USERNAME', 'INSERT_PASSWORD');

// Output user information
var_dump($envelope->getLoggedInUser());