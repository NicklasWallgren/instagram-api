<?php

use Instagram\SDK\Instagram;

require_once __DIR__ . '/../vendor/autoload.php';

$instagram = Instagram::builder()->build();
$response = $instagram->login('INSERT_USERNAME', 'INSERT_PASSWORD');

// Retrieve the session for the authenticated user
$session = $response->getSession();

// Persist to session to a local file (or database, cache, session)
file_put_contents($session->getUser()->getUsername(), serialize($session));

// Restore the session from local file
$session = unserialize(file_get_contents($session->getUser()->getUsername()));

// Initialize a new instance of the instagram library
$instagram = Instagram::builder()
    ->setSession($session)
    ->build();

// Retrieve the inbox
$response = $instagram->inbox();
var_dump($response->isSuccess());
