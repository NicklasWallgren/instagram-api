<?php

namespace Instagram\SDK\Responses\Interfaces;

use GuzzleHttp\Promise\PromiseInterface;

/**
 * Interface IteratorInterface
 *
 * @package Instagram\SDK\Responses\Interfaces
 */
interface IteratorInterface
{

    public function next();

    public function nextPromise(): PromiseInterface;

    public function rewind();

    public function rewindPromise(): PromiseInterface;
}
