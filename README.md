# Instagram Private API

[![PHP7.1 Ready](https://img.shields.io/badge/PHP71-ready-green.svg)][link-packagist]

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

Promise adapter
```php
use NicklasW\Instagram\Responses\Exceptions\InvalidResponseException;
use NicklasW\Instagram\DTO\Messages\InboxMessage;
use NicklasW\Instagram\DTO\Messages\SessionMessage;
use NicklasW\Instagram\Instagram;

require_once 'vendor/autoload.php';

$instagram = new Instagram(null, null, new PromiseAdapter());

$instagram
    ->login('INSERT_USERNAME', 'INSERT_PASSWORD')
    ->then(function (SessionMessage $envelope) use ($instagram) {
        return $instagram->inbox();
    })->then(function (InboxMessage $envelope) {
        // Outputs the threads
        var_dump($envelope->getInbox()->getThreads());
    })->otherwise(function (InvalidResponseException $exception) {
        // Outputs the error message
        var_dump($exception->getEnvelope()->getMessage());
    })
    ->wait();
```

Unwrap adapter
```php
use NicklasW\Instagram\DTO\General\ItemType;
use NicklasW\Instagram\Instagram;

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