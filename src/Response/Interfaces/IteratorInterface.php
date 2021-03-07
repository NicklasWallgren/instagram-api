<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Interfaces;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Exceptions\InstagramException;
use Instagram\SDK\Response\Responses\ResponseEnvelope;

/**
 * Interface IteratorInterface
 *
 * @package Instagram\SDK\Response\Interfaces
 */
interface IteratorInterface
{

    /**
     * @return ResponseEnvelope|null
     * @throws InstagramException
     */
    public function next();

    /**
     * @return PromiseInterface<?ResponseEnvelope|InstagramException>
     */
    public function nextPromise(): PromiseInterface;

    /**
     * @return ResponseEnvelope|null
     * @throws InstagramException
     */
    public function rewind();

    /**
     * @return PromiseInterface<?ResponseEnvelope|InstagramException>
     */
    public function rewindPromise(): PromiseInterface;
}
