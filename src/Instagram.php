<?php

declare(strict_types=1);

namespace Instagram\SDK;

use Instagram\SDK\Client\Client;
use Instagram\SDK\Traits\MakeRequestsAccessible;

/**
 * Class Instagram
 *
 * @package Instagram\SDK
 */
final class Instagram
{

    use MakeRequestsAccessible;

    /** @var Client */
    private $client;

    /**
     * Instagram constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Create a new {@link InstagramBuilder}.
     *
     * @return InstagramBuilder
     */
    public static function builder(): InstagramBuilder
    {
        return new InstagramBuilder();
    }

    /**
     * Returns the {@link Client}.
     *
     * @return Client
     */
    protected function getClient(): Client
    {
        return $this->client;
    }
}
