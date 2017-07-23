<?php

namespace Instagram\SDK\Client\Features;

use GuzzleHttp\Promise\Promise;
use Instagram\SDK\DTO\Messages\Discover\ChannelsMessage;
use Instagram\SDK\DTO\Messages\Discover\ExploreMessage;
use Instagram\SDK\DTO\Messages\Discover\TopLiveMessage;
use Instagram\SDK\Requests\Discover\ChannelsRequest;
use Instagram\SDK\Requests\Discover\ExploreRequest;
use Instagram\SDK\Requests\Discover\TopLiveRequest;
use function Instagram\SDK\Support\Promises\task;

trait DiscoverFeaturesTrait
{

    use DefaultFeaturesTrait;

    /**
     * Retrieves the discover explore items.
     *
     * @return ExploreMessage|Promise<ExploreMessage>
     */
    public function explore()
    {
        return task(function () {
            $this->checkPrerequisites();

            return (new ExploreRequest($this, $this->session, $this->client))->fire();
        })($this->getMode());
    }

    /**
     * Retrieves the discover top lives items.
     *
     * @return TopLiveMessage|Promise<TopLiveMessage>
     */
    public function topLives()
    {
        return task(function () {
            $this->checkPrerequisites();

            return (new TopLiveRequest($this, $this->session, $this->client))->fire();
        })($this->getMode());
    }

    /**
     * Retrieves the discover channels items.
     *
     * @return ChannelsMessage|Promise<ChannelsMessage>
     */
    public function channels()
    {
        return task(function () {
            $this->checkPrerequisites();

            return (new ChannelsRequest($this, $this->session, $this->client))->fire();
        })($this->getMode());
    }
}
