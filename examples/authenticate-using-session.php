<?php

use Instagram\SDK\Instagram;

require_once __DIR__ . '/../vendor/autoload.php';

// Initialize the Instagram library
$instagram = new Instagram();

// Authenticate using username and password
$envelope = $instagram->login('INSERT_USERNAME', 'INSERT_PASSWORD');

// Retrieve the active session
$session = $envelope->getSession();

// Persist to file (or database, cache, session)
file_put_contents($session->getUser()->getUsername(), serialize($session));

// Restore the session
$session = unserialize(file_get_contents($session->getUser()->getUsername()));

// Initialize a new instance of the instagram library
$instagram = new Instagram();

// Set the active session
$instagram->setSession($session);

// Retrieve the inbox
$envelope = $instagram->inbox();

// Output the request status
var_dump($envelope->isSuccess());

