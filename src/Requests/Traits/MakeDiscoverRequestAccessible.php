<?php

namespace Instagram\SDK\Requests\Traits;

use GuzzleHttp\Promise\Promise;
use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Messages\Discover\ChannelsMessage;
use Instagram\SDK\DTO\Messages\Discover\ExploreMessage;
use Instagram\SDK\DTO\Messages\Discover\TopLiveMessage;

/**
 * Trait MakeDiscoverRequestAccessible
 *
 * @package Instagram\SDK\Requests\Traits
 */
trait MakeDiscoverRequestAccessible
{

    /**
     * Returns the discover explore items.
     *
     * @return ExploreMessage|Promise<ExploreMessage>
     */
    public function explore()
    {
        return $this->getClient()->explore();
    }

    /**
     * Returns the discover top lives items.
     *
     * @return TopLiveMessage|Promise<TopLiveMessage>
     */
    public function topLives()
    {
        return $this->getClient()->topLives();
    }

    /**
     * Returns the discover channels items.
     *
     * @return ChannelsMessage|Promise<ChannelsMessage>
     */
    public function channels()
    {
        return $this->getClient()->channels();
    }

    /**
     * Returns the client.
     *
     * @return Client
     */
    abstract protected function getClient(): Client;
}
