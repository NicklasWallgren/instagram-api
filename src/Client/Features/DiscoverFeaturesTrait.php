<?php

declare(strict_types=1);

namespace Instagram\SDK\Client\Features;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\DTO\Messages\Discover\ChannelsMessage;
use Instagram\SDK\DTO\Messages\Discover\ExploreMessage;
use Instagram\SDK\DTO\Messages\Discover\TopLiveMessage;
use function GuzzleHttp\Promise\task;

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
     * @return PromiseInterface<ExploreMessage>
     */
    public function explore(): PromiseInterface
    {
        return task(function (): PromiseInterface {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            $request = $this->buildRequest('discover/explore/', new ExploreMessage(), 'GET');

            return $this->call($request);
        });
    }

    /**
     * Retrieves the discover top lives items.
     *
     * @return PromiseInterface<TopLiveMessage>
     */
    public function topLives(): PromiseInterface
    {
        return task(function (): PromiseInterface {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            $request = $this->buildRequest('discover/top_live/', new TopLiveMessage(), 'GET');

            return $this->call($request);
        });
    }

    /**
     * Retrieves the discover channels items.
     *
     * @return PromiseInterface<ChannelsMessage>
     */
    public function channels(): PromiseInterface
    {
        return task(function (): PromiseInterface {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            $request = $this->buildRequest('discover/channels_home/', new ChannelsMessage(), 'GET');

            return $this->call($request);
        });
    }
}
