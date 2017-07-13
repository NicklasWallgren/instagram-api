# Instagram Private API

[![PHP7.1 Ready](https://img.shields.io/badge/PHP71-ready-green.svg)][link-packagist]
[![Latest Stable Version](https://poser.pugx.org/nicklasw/instagram-api/v/stable)](https://packagist.org/packages/nicklasw/instagram-api)
[![Latest Unstable Version](https://poser.pugx.org/nicklasw/instagram-api/v/unstable)](https://packagist.org/packages/nicklasw/instagram-api)
[![Build Status](https://travis-ci.org/NicklasWallgren/instagram-api.svg?branch=master)](https://travis-ci.org/NicklasWallgren/instagram-api)
[![License](https://poser.pugx.org/nicklasw/instagram-api/license)](https://packagist.org/packages/nicklasw/instagram-api)

Instagram Private API library

# Installation
You can install this by using composer 
```
composer require nicklasw/instagram-api
```

# Features
- Supports asynchronous and parallel requests
- Easily extendable with new requests
- Session and device management
- Access discover feeds (channels, explore, top live)
- Access direct feeds (inbox, thread)
- Much more

# Usage

## Promise pattern

### Basic example
```php
use Instagram\SDK\Responses\Exceptions\ApiResponseException;
use Instagram\SDK\DTO\Messages\InboxMessage;
use Instagram\SDK\DTO\Messages\SessionMessage;
use Instagram\SDK\Instagram;

require_once 'vendor/autoload.php';

$instagram = new Instagram();

// Set result mode
$instagram->setMode(Instagram::MODE_PROMISE);

$instagram
    ->login('INSERT_USERNAME', 'INSERT_PASSWORD')
    ->then(function (SessionMessage $envelope) use ($instagram) {
        return $instagram->inbox();
    })->then(function (InboxMessage $envelope) {
        // Outputs the threads
        var_dump($envelope->getInbox()->getThreads());
    })->otherwise(function (ApiResponseException $exception) {
        // Outputs the error message
        var_dump($exception->getEnvelope()->getMessage());
    })
    ->wait();
```

### Flat promise example


```php
use Instagram\SDK\Responses\Exceptions\ApiResponseException;
use Instagram\SDK\DTO\Messages\InboxMessage;
use Instagram\SDK\DTO\Messages\SessionMessage;
use Instagram\SDK\Instagram;

require_once 'vendor/autoload.php';

$instagram = new Instagram();

// Set result mode
$instagram->setMode(Instagram::MODE_PROMISE);

$instagram
    ->login('INSERT_USERNAME', 'INSERT_PASSWORD')
    ->wait();

// Flat promise chain
$threads = $instagram
    ->inbox()
    ->getInbox()
    ->getThreads()
    ->wait();

```

## Unwrap pattern

### Basic example
```php
use Instagram\SDK\DTO\General\ItemType;
use Instagram\SDK\Instagram;

require_once 'vendor/autoload.php';

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
```

## Exception classes
- ApiResponseException
    - Generic API response exception, includes envelope
- BadPasswordException
- InvalidUserException
- RateLimitException
- InvalidResponseException
    - Generic HTTP response exception


## Proxy

### To be updated

```php
require_once '/vendor/autoload.php';

// Create the guzzle client
$client = new GuzzleHttp\Client(['proxy' => 'INSERT_PROXY']);

// Initialize the Instagram library, pass the client
$instagram = new Instagram($client);

// Authenticate using username and password
$envelope = $instagram->login('INSERT_USERNAME', 'INSERT_PASSWORD')->wait();

// Output the response
var_dump($envelope);

```

## Contributing
  - Fork it!
  - Create your feature branch: `git checkout -b my-new-feature`
  - Commit your changes: `git commit -am 'Useful information about your new features'`
  - Push to the branch: `git push origin my-new-feature`
  - Submit a pull request

## Contributors
  - [Nicklas Wallgren](https://github.com/NicklasWallgren)
  - [All Contributors][link-contributors]

## Credits
- [mgp25](https://github.com/mgp25) for the inspiration

[ico-downloads]: https://img.shields.io/packagist/dt/nicklasw/instagram-api.svg?style=flat-square
[link-packagist]: https://packagist.org/packages/nicklasw/instagram-api
[link-contributors]: ../../contributors