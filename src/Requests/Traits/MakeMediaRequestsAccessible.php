<?php

namespace Instagram\SDK\Requests\Traits;

use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\Support\Promise;

/**
 * Trait MakeMediaRequestsAccessible
 *
 * @package Instagram\SDK\Requests\Traits
 */
trait MakeMediaRequestsAccessible
{

    /**
     * @param string $mediaId
     * @return Envelope|Promise<Envelope>
     */
    public function like(string $mediaId)
    {
        return $this->getClient()->like($mediaId);
    }

    /**
     * @param string $mediaId
     * @return Envelope|Promise<Envelope>
     */
    public function unlike(string $mediaId)
    {
        return $this->getClient()->unlike($mediaId);
    }

    /**
     * Returns the client.
     *
     * @return Client
     */
    abstract protected function getClient(): Client;
}
