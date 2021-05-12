<?php

declare(strict_types=1);

use Instagram\SDK\Instagram;

require_once __DIR__ . '/../vendor/autoload.php';

// Authenticate
$instagram = Instagram::builder()->build();
$instagram->login('INSERT_USERNAME', 'INSERT_PASSWORD');

$inbox = $instagram->inbox()
    ->getInbox();

// Retrieve the available threads
$threads = $inbox->getThreads();

// Output the threads
var_dump($threads);