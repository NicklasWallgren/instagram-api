<?php

declare(strict_types=1);

namespace Instagram\SDK\Client\Features;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\DTO\Messages\Friendships\FollowersMessage;
use Instagram\SDK\DTO\Messages\Friendships\FollowingMessage;
use Instagram\SDK\DTO\Messages\Friendships\FollowMessage;
use Instagram\SDK\Requests\Request;
use Instagram\SDK\Requests\Http\Factories\PayloadSerializerFactory;
use function GuzzleHttp\Promise\task;
use function Instagram\SDK\Support\request;

/**
 * Trait FriendshipsFeaturesTrait
 *
 * @package            Instagram\SDK\Client\Features
 * @phan-file-suppress PhanUnreferencedUseNormal
 */
trait FriendshipsFeaturesTrait
{

    use DefaultFeaturesTrait;

    /**
     * Follow a user by user id.
     *
     * @param string $userId
     * @return PromiseInterface<FollowMessage>
     */
    public function follow(string $userId): PromiseInterface
    {
        return task(function () use ($userId): PromiseInterface {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            /** @var Request $request */
            // @phan-suppress-next-line PhanPluginPrintfVariableFormatString
            $request = request(sprintf('friendships/create/%s/', $userId), new FollowMessage())(
                $this,
                $this->session,
                $this->client
            );

            // Prepare the request payload
            $request
                ->addCSRFTokenAndUserId()
                ->addUuid()
                ->addPayloadParam('user_id', $userId)
                ->setPayloadSerializerType(PayloadSerializerFactory::TYPE_SIGNED);

            return $request->fire();
        });
    }

    /**
     * Unfollow a user by user id.
     *
     * @param string $userId
     * @return PromiseInterface<FollowMessage>
     */
    public function unfollow(string $userId): PromiseInterface
    {
        return task(function () use ($userId): PromiseInterface {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            /**
             * @var Request $request
             */
            // @phan-suppress-next-line PhanPluginPrintfVariableFormatString
            $request = request(sprintf('friendships/destroy/%s/', $userId), new FollowMessage())(
                $this,
                $this->session,
                $this->client
            );

            // Prepare the request payload
            $request
                ->addCSRFTokenAndUserId()
                ->addUuid()
                ->addPayloadParam('user_id', $userId)
                ->setPayloadSerializerType(PayloadSerializerFactory::TYPE_SIGNED);

            return $request->fire();
        });
    }

    /**
     * Returns a list of followers.
     *
     * @param string      $userId
     * @param string|null $maxId
     * @return PromiseInterface<FollowersMessage>
     */
    public function followers(string $userId, ?string $maxId = null): PromiseInterface
    {
        return task(function () use ($userId, $maxId): PromiseInterface {
            /** @var Request $request */
            // @phan-suppress-next-line PhanPluginPrintfVariableFormatString
            // phpcs:ignore
            $request = request(sprintf('friendships/%s/followers/', $userId), (new FollowersMessage())->setUserId($userId))(
                $this,
                $this->session,
                $this->client
            );

            // Prepare the request payload
            $request
                ->addRankedToken()
                ->addQueryParamIfNotNull('max_id', $maxId);

            return $request->fire();
        });
    }

    /**
     * Returns a list of following users.
     *
     * @param string      $userId
     * @param null|string $maxId
     * @return PromiseInterface<FollowingMessage>
     */
    public function following(string $userId, ?string $maxId): PromiseInterface
    {
        return task(function () use ($userId, $maxId): PromiseInterface {
            /** @var Request $request */
            // @phan-suppress-next-line PhanPluginPrintfVariableFormatString
            // phpcs:ignore
            $request = request(sprintf('friendships/%s/following/', $userId), (new FollowingMessage())->setUserId($userId))(
                $this,
                $this->session,
                $this->client
            );

            // Prepare the request payload
            $request
                ->addRankedToken()
                ->addQueryParamIfNotNull('max_id', $maxId);

            return $request->fire();
        });
    }
}
