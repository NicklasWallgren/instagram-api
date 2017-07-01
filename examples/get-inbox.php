<?php

use Instagram\SDK\Instagram;

require_once __DIR__ . '/../vendor/autoload.php';

// Initialize the Instagram library
$instagram = new Instagram();

// Authenticate using username and password
$instagram->login('INSERT_USERNAME', 'INSERT_PASSWORD');

// Retrieve the inbox envelope
$envelope = $instagram->inbox();

// Retrieve the inbox
$inbox = $envelope->getInbox();

// Retrieve the available threads
$threads = $inbox->getThreads();

// Output the threads
var_dump($threads);