<?php

declare(strict_types=1);

use Instagram\SDK\Instagram;
use Instagram\SDK\Response\DTO\General\ItemType;

require_once __DIR__ . '/../vendor/autoload.php';

$instagram = Instagram::builder()->build();
$instagram->login('INSERT_USERNAME', 'INSERT_PASSWORD');

$response = $instagram->inbox();
$inbox = $response->getInbox();

// Retrieve the first thread in the inbox
if (!$thread = current($inbox->getThreads())) {
    // No thread found
    return;
}

// Retrieve the whole thread including thread items
$thread = $thread->whole()->getThread();

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
$threadItemsInNextPage = $thread->next()->getThread();

var_dump($threadItemsInNextPage->getItems());


