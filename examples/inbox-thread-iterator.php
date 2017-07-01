<?php

use Instagram\SDK\DTO\General\ItemType;
use Instagram\SDK\Instagram;

require_once __DIR__ . '/../vendor/autoload.php';

// Initialize the Instagram library
$instagram = new Instagram();

// Authenticate using username and password
$instagram->login('INSERT_USERNAME', 'INSERT_PASSWORD');

// Invoke the request
$envelope = $instagram->inbox();

// Retrieve the inbox
$inbox = $envelope->getInbox();

// Retrieve the first thread in the inbox
if(!$thread = current($inbox->getThreads())) {
    // No thread found
    return;
}

// Retrieve the whole thread including thread items
$thread->whole();

// Iterate through the list of items
foreach ($thread->getItems() as $item) {
    // Check whether the item is of type media
    if ($item->isItemType(ItemType::MEDIA)) {
        // Retrieve the images
        $images = $item->getMedia()->getImages()->getCandidates();

        foreach ($images as $image) {
            // Output the image url
            var_dump($image->getUrl());
        }
    }
}

// Retrieve the next batch of thread items
$thread->next();

var_dump($thread->getItems());


