<?php

declare(strict_types=1);

namespace Instagram\SDK\Client\Features;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Exceptions\InstagramException;
use Instagram\SDK\Request\Http\Factories\PayloadSerializerFactory;
use Instagram\SDK\Response\Responses\Friendships\FollowersResponse;
use Instagram\SDK\Response\Responses\Friendships\FollowingResponse;
use Instagram\SDK\Response\Responses\Friendships\FollowResponse;

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
     * @return PromiseInterface<FollowResponse|InstagramException>
     */
    public function follow(string $userId): PromiseInterface
    {
        return $this->authenticated(function () use ($userId): PromiseInterface {
            // @phan-suppress-next-line PhanPluginPrintfVariableFormatString, PhanThrowTypeAbsentForCall
            $request = $this->buildRequest(sprintf('friendships/create/%s/', $userId), new FollowResponse())
                ->addCSRFTokenAndUserId($this->session)
                ->addUuid($this->session)
                ->addPayloadParam('user_id', $userId)
                ->setPayloadSerializerType(PayloadSerializerFactory::TYPE_SIGNED);

            return $this->call($request);
        });
    }

    /**
     * Unfollow a user by user id.
     *
     * @param string $userId
     * @return PromiseInterface<FollowResponse|InstagramException>
     */
    public function unfollow(string $userId): PromiseInterface
    {
        return $this->authenticated(function () use ($userId): PromiseInterface {
            // @phan-suppress-next-line PhanPluginPrintfVariableFormatString, PhanThrowTypeAbsentForCall
            $request = $this->buildRequest(sprintf('friendships/destroy/%s/', $userId), new FollowResponse())
                ->addCSRFTokenAndUserId($this->session)
                ->addUuid($this->session)
                ->addPayloadParam('user_id', $userId)
                ->setPayloadSerializerType(PayloadSerializerFactory::TYPE_SIGNED);

            return $this->call($request);
        });
    }

    /**
     * Returns a list of followers.
     *
     * @param string      $userId
     * @param string|null $maxId
     * @return PromiseInterface<FollowersResponse|InstagramException>
     */
    public function followers(string $userId, ?string $maxId = null): PromiseInterface
    {
        return $this->authenticated(function () use ($userId, $maxId): PromiseInterface {
            // @phan-suppress-next-line PhanPluginPrintfVariableFormatString
            // phpcs:ignore
            $request = $this->buildRequest(sprintf('friendships/%s/followers/', $userId), new FollowersResponse($userId), 'GET')
                ->addRankedToken($this->session)
                ->addQueryParam('rank_mutual', 0)
                ->addQueryParamIfNotNull('max_id', $maxId);

            return $this->call($request);
        });
    }

    /**
     * Returns a list of following users.
     *
     * @param string      $userId
     * @param null|string $maxId
     * @return PromiseInterface<FollowingResponse|InstagramException>
     */
    public function following(string $userId, ?string $maxId): PromiseInterface
    {
        return $this->authenticated(function () use ($userId, $maxId): PromiseInterface {
            // phpcs:ignore
            $request = $this->buildRequest(sprintf('friendships/%s/following/', $userId), new FollowingResponse($userId), 'GET');

            // Prepare the request payload
            $request
                ->addRankedToken($this->session)
                ->addQueryParam('rank_mutual', 0)
                ->addQueryParamIfNotNull('max_id', $maxId);

            return $this->call($request);
        });
    }
}
