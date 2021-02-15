<?php

declare(strict_types=1);

namespace Instagram\SDK\Client\Features;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\DTO\Messages\Discover\ChannelsMessage;
use Instagram\SDK\DTO\Messages\Discover\ExploreMessage;
use Instagram\SDK\DTO\Messages\Discover\TopLiveMessage;
use Instagram\SDK\Requests\GenericRequest;
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
     * @return PromiseInterface<ExploreMessage>
     */
    public function explore(): PromiseInterface
    {
        return task(function (): PromiseInterface {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            /** @var GenericRequest $request */
            $request = request('discover/explore/', new ExploreMessage(), 'GET')(
                $this,
                $this->session,
                $this->client
            );

            return $request->fire();
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

            /** @var GenericRequest $request */
            $request = request('discover/top_live/', new TopLiveMessage(), 'GET')(
                $this,
                $this->session,
                $this->client
            );

            return $request->fire();
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

            /** @var GenericRequest $request */
            $request = request('discover/channels_home/', new ChannelsMessage(), 'GET')(
                $this,
                $this->session,
                $this->client
            );

            return $request->fire();
        });
    }
}
