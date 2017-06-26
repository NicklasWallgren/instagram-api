<?php

namespace NicklasW\Instagram\Requests\Traits;

use GuzzleHttp\Promise\Promise;
use NicklasW\Instagram\Client\Client;
use NicklasW\Instagram\DTO\Messages\Discover\ChannelsMessage;
use NicklasW\Instagram\DTO\Messages\Discover\ExploreMessage;
use NicklasW\Instagram\DTO\Messages\Discover\TopLiveMessage;

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
