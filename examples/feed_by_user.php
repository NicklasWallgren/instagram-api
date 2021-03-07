<?php

declare(strict_types=1);

use Instagram\SDK\Instagram;

require_once __DIR__ . '/../vendor/autoload.php';

// Authenticate
$instagram = Instagram::builder()->build();
$instagram->login('INSERT_USERNAME', 'INSERT_PASSWORD');

$response = $instagram->feedByUser('301061552');
print_r($response);
