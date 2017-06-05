<?php

use NicklasW\Instagram\Client\Adapters\PromiseAdapter;
use NicklasW\Instagram\DTO\Messages\SessionMessage;
use NicklasW\Instagram\Instagram;

require_once __DIR__ . '/../vendor/autoload.php';

// Initialize the Instagram library
$instagram = new Instagram(null, null, new PromiseAdapter());

// Authenticate using username and password
$promise = $instagram->login('username', 'password');

$promise->then(function (SessionMessage $envelope) {
    // The on success callback
})->otherwise(function ($exception) {
    // The on error callback

    // Retrieve the response evelope
    $envelope = $exception->getEnvelope();

    // Output the envelope error message
    var_dump($envelope->getMessage());
});

$promise->wait(false);
