<?php

declare(strict_types=1);

namespace Instagram\SDK\Client\Features;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Exceptions\InstagramException;
use Instagram\SDK\Response\Responses\Discover\ChannelsResponse;
use Instagram\SDK\Response\Responses\Discover\ExploreResponse;
use Instagram\SDK\Response\Responses\Discover\TopLiveResponse;

/**
 * Trait DiscoverFeaturesTrait
 *
 * @package Instagram\SDK\Client\Features
 */
trait DiscoverFeaturesTrait
{

    use DefaultFeaturesTrait;

    /**
     * Retrieve the discover explore items.
     *
     * @return PromiseInterface<ExploreResponse|InstagramException>
     */
    public function explore(): PromiseInterface
    {
        return $this->authenticated(function (): PromiseInterface {
            $request = $this->buildRequest('discover/explore/', new ExploreResponse(), 'GET');

            return $this->call($request);
        });
    }

    /**
     * Retrieve the discover top lives items.
     *
     * @return PromiseInterface<TopLiveResponse|InstagramException>
     */
    public function topLives(): PromiseInterface
    {
        return $this->authenticated(function (): PromiseInterface {
            $request = $this->buildRequest('discover/top_live/', new TopLiveResponse(), 'GET');

            return $this->call($request);
        });
    }

    /**
     * Retrieve the discover channels items.
     *
     * @return PromiseInterface<ChannelsResponse|InstagramException>
     */
    public function channels(): PromiseInterface
    {
        return $this->authenticated(function (): PromiseInterface {
            $request = $this->buildRequest('discover/channels_home/', new ChannelsResponse(), 'GET');

            return $this->call($request);
        });
    }
}
