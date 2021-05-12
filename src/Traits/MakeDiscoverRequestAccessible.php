<?php

declare(strict_types=1);

namespace Instagram\SDK\Traits;

use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Client\Client;
use Instagram\SDK\Exceptions\InstagramException;
use Instagram\SDK\Response\Responses\Discover\ChannelsResponse;
use Instagram\SDK\Response\Responses\Discover\ExploreResponse;
use Instagram\SDK\Response\Responses\Discover\TopLiveResponse;
use Instagram\SDK\Utils\PromiseUtils;

/**
 * Trait MakeDiscoverRequestAccessible
 *
 * @package Instagram\SDK\Traits
 */
trait MakeDiscoverRequestAccessible
{

    /**
     * Returns the discover explore items.
     *
     * @return ExploreResponse
     * @throws InstagramException in case of an error
     */
    public function explore(): ExploreResponse
    {
        return PromiseUtils::wait($this->explorePromise());
    }

    /**
     * Returns the discover explore items.
     *
     * @return PromiseInterface<ExploreResponse|InstagramException>
     */
    public function explorePromise(): PromiseInterface
    {
        return $this->getClient()->explore();
    }

    /**
     * Returns the discover top lives items.
     *
     * @return TopLiveResponse
     * @throws InstagramException in case of an error
     */
    public function topLives()
    {
        return PromiseUtils::wait($this->topLivesPromise());
    }

    /**
     * Returns the discover top lives items.
     *
     * @return Promise<TopLiveResponse|InstagramException>
     */
    public function topLivesPromise(): PromiseInterface
    {
        return $this->getClient()->topLives();
    }

    /**
     * Returns the discover channels items.
     *
     * @return ChannelsResponse
     * @throws InstagramException in case of an error
     */
    public function channels(): ChannelsResponse
    {
        return PromiseUtils::wait($this->channelsPromise());
    }

    /**
     * Returns the discover channels items.
     *
     * @return PromiseInterface<ChannelsResponse|InstagramException>
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
