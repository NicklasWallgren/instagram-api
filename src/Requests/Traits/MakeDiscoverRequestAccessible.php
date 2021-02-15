<?php

namespace Instagram\SDK\Requests\Traits;

use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Promise\PromiseInterface;
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
     * @return ExploreMessage
     */
    public function explore(): ExploreMessage
    {
        return $this->explorePromise()->wait();
    }

    /**
     * Returns the discover explore items.
     *
     * @return PromiseInterface<ExploreMessage>
     */
    public function explorePromise(): PromiseInterface
    {
        return $this->getClient()->explore();
    }

    /**
     * Returns the discover top lives items.
     *
     * @return TopLiveMessage
     */
    public function topLives()
    {
        return $this->topLivesPromise()->wait();
    }

    /**
     * Returns the discover top lives items.
     *
     * @return Promise<TopLiveMessage>
     */
    public function topLivesPromise(): PromiseInterface
    {
        return $this->getClient()->topLives();
    }

    /**
     * Returns the discover channels items.
     *
     * @return ChannelsMessage
     */
    public function channels(): ChannelsMessage
    {
        return $this->channelsPromise()->wait();
    }

    /**
     * Returns the discover channels items.
     *
     * @return PromiseInterface<ChannelsMessage>
     */
    public function channelsPromise(): PromiseInterface
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
