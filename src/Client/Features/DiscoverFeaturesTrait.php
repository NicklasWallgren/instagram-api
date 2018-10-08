<?php

namespace Instagram\SDK\Client\Features;

use Instagram\SDK\DTO\Messages\Discover\ChannelsMessage;
use Instagram\SDK\DTO\Messages\Discover\ExploreMessage;
use Instagram\SDK\DTO\Messages\Discover\TopLiveMessage;
use Instagram\SDK\Requests\Discover\ChannelsRequest;
use Instagram\SDK\Requests\Discover\ExploreRequest;
use Instagram\SDK\Requests\Discover\TopLiveRequest;
use Instagram\SDK\Support\Promise;
use function Instagram\SDK\Support\Promises\task;

/**
 * Trait DiscoverFeaturesTrait
 *
 * @package Instagram\SDK\Client\Features
 */
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
        return task(function (): Promise {
            $this->checkPrerequisites();

            return (new ExploreRequest($this->getSubject(), $this->session, $this->client))->fire();
        })($this->getMode());
    }

    /**
     * Retrieves the discover top lives items.
     *
     * @return TopLiveMessage|Promise<TopLiveMessage>
     */
    public function topLives()
    {
        return task(function (): Promise {
            $this->checkPrerequisites();

            return (new TopLiveRequest($this->getSubject(), $this->session, $this->client))->fire();
        })($this->getMode());
    }

    /**
     * Retrieves the discover channels items.
     *
     * @return ChannelsMessage|Promise<ChannelsMessage>
     */
    public function channels()
    {
        return task(function (): Promise {
            $this->checkPrerequisites();

            return (new ChannelsRequest($this->getSubject(), $this->session, $this->client))->fire();
        })($this->getMode());
    }
}
