<?php

namespace Instagram\SDK\Client\Features;

use Instagram\SDK\DTO\Messages\Discover\ChannelsMessage;
use Instagram\SDK\DTO\Messages\Discover\ExploreMessage;
use Instagram\SDK\DTO\Messages\Discover\TopLiveMessage;
use Instagram\SDK\Requests\Discover\ExploreRequest;
use Instagram\SDK\Requests\Discover\TopLiveRequest;
use Instagram\SDK\Requests\GenericRequest;
use Instagram\SDK\Support\Promise;
use function Instagram\SDK\Support\Promises\task;
use function Instagram\SDK\Support\request;

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
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            /** @var GenericRequest $request */
            $request = request('discover/explore/', new ExploreMessage(), 'GET')(
                $this,
                $this->session,
                $this->client
            );

            // Invoke the request
            return $request->fire();
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
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            /** @var GenericRequest $request */
            $request = request('discover/top_live/', new TopLiveMessage(), 'GET')(
                $this,
                $this->session,
                $this->client
            );

            // Invoke the request
            return $request->fire();
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
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            /** @var GenericRequest $request */
            $request = request('discover/channels_home/', new ChannelsMessage(), 'GET')(
                $this,
                $this->session,
                $this->client
            );

            // Invoke the request
            return $request->fire();
        })($this->getMode());
    }
}
