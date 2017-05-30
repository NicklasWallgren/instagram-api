# Instagram Private API

[![Total Downloads][ico-downloads]][link-packagist]
[![PHP7.1 Ready](https://img.shields.io/badge/PHP71-ready-green.svg)][link-packagist]

Instagram Private API library

# Install
Run the command `composer require nicklasw/instagram-api`.

# Features
- Supports asynchronous requests
- Easily extendable with new requests

# Usage
EG:
```php

use NicklasW\Instagram\DTO\General\ItemType;
use NicklasW\Instagram\Instagram;

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