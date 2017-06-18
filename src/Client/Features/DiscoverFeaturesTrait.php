<?php

namespace NicklasW\Instagram\Client\Features;

use GuzzleHttp\Promise\Promise;
use NicklasW\Instagram\DTO\Messages\Discover\ChannelsMessage;
use NicklasW\Instagram\DTO\Messages\Discover\ExploreMessage;
use NicklasW\Instagram\DTO\Messages\Discover\TopLiveMessage;
use NicklasW\Instagram\Requests\Discover\ChannelsRequest;
use NicklasW\Instagram\Requests\Discover\ExploreRequest;
use NicklasW\Instagram\Requests\Discover\TopLiveRequest;

trait DiscoverFeaturesTrait
{

    /**
     * Retrieves the discover explore items.
     *
     * @return ExploreMessage|Promise<ExploreMessage>
     */
    public function explore()
    {
        return $this->adapter->run(function () {
            $this->checkPrerequisites();

            return (new ExploreRequest($this, $this->session, $this->client))->fire();
        });
    }

    /**
     * Retrieves the discover top lives items.
     *
     * @return TopLiveMessage|Promise<TopLiveMessage>
     */
    public function topLives()
    {
        return $this->adapter->run(function () {
            $this->checkPrerequisites();

            return (new TopLiveRequest($this, $this->session, $this->client))->fire();
        });
    }

    /**
     * Retrieves the discover channels items.
     *
     * @return ChannelsMessage|Promise<ChannelsMessage>
     */
    public function channels()
    {
        return $this->adapter->run(function () {
            $this->checkPrerequisites();

            return (new ChannelsRequest($this, $this->session, $this->client))->fire();
        });
    }


}