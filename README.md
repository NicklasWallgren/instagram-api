[![PHP7.2 Ready](https://img.shields.io/badge/PHP72-ready-green.svg)][link-packagist]
[![Latest Stable Version](https://poser.pugx.org/nicklasw/instagram-api/v/stable)](https://packagist.org/packages/nicklasw/instagram-api)
[![Latest Unstable Version](https://poser.pugx.org/nicklasw/instagram-api/v/unstable)](https://packagist.org/packages/nicklasw/instagram-api)
[![Build Status](https://travis-ci.org/NicklasWallgren/instagram-api.svg?branch=master)](https://travis-ci.org/NicklasWallgren/instagram-api)
[![License](https://poser.pugx.org/nicklasw/instagram-api/license)](https://packagist.org/packages/nicklasw/instagram-api)

# Instagram Private API Library
To learn how to use this library, please refer to the source code as well as the [examples](./examples).

## Installation

You can install this library by using composer
```bash
composer require nicklasw/instagram-api
```

## Features
- Supports asynchronous and parallel requests
- Easily extendable with new requests
- Session and device management
- Access discover feeds (channels, explore, top live)
- Access direct feeds (inbox, thread)
- Much more

## Example

```php
<?php

use Instagram\SDK\Instagram;

require_once 'vendor/autoload.php';

$instagram = Instagram::builder()->build();
$instagram->login('INSERT_USERNAME', 'INSERT_PASSWORD');

$response = $instagram->inbox();

foreach ($response->getInbox()->getThreads() as $thread) {
    $thread->sendMessage("Hello");
}
```

## Changelog

Please see the [changelog](./CHANGELOG.md) for a release history and indications on how to upgrade from one version to another.

## Contributing

If you find any problems or have suggestions about this crate, please submit an issue. Moreover, any pull request, code review and feedback are welcome.

### Code Guide

We use GitHub Actions to make sure the codebase is consistent (`composer run lint-fix && composer run code-analyze`). We try to keep comments at a maximum of
160 characters of length and code at 120.

## License

[MIT](./LICENSE)

[ico-downloads]: https://img.shields.io/packagist/dt/nicklasw/instagram-api.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/nicklasw/instagram-api

[link-contributors]: ../../contributors