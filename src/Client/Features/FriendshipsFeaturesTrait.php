<?php

namespace Instagram\SDK\Client\Features;

use Instagram\SDK\DTO\Messages\Friendships\FollowersMessage;
use Instagram\SDK\DTO\Messages\Friendships\FollowingMessage;
use Instagram\SDK\DTO\Messages\Friendships\FollowMessage;
use Instagram\SDK\Requests\GenericRequest;
use Instagram\SDK\Requests\Http\Factories\SerializerFactory;
use Instagram\SDK\Support\Promise;
use function Instagram\SDK\Support\Promises\task;
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
     * @var string
     */
    private static $URI_FOLLOW = 'friendships/create/%s/';

    /**
     * @var string
     */
    private static $URI_UNFOLLOW = 'friendships/destroy/%s/';

    /**
     * @var string
     */
    private static $URI_FOLLOWERS = 'friendships/%s/followers/';

    /**
     * @var string
     */
    private static $URI_FOLLOWING = 'friendships/%s/following/';

    /**
     * Follow a user by user id.
     *
     * @param string $userId
     * @return FollowMessage|Promise<FollowMessage>
     */
    public function follow(string $userId)
    {
        return task(function () use ($userId): Promise {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            /** @var GenericRequest $request */
            // @phan-suppress-next-line PhanPluginPrintfVariableFormatString
            $request = request(sprintf(self::$URI_FOLLOW, $userId), new FollowMessage())(
                $this,
                $this->session,
                $this->client
            );

            // Prepare the request payload
            $request
                ->addCSRFTokenAndUserId()
                ->addUuid()
                ->addPayloadParam('user_id', $userId)
                ->setSerializerType(SerializerFactory::SIGNED);

            // Invoke the request
            return $request->fire();
        })($this->getMode());
    }

    /**
     * Unfollow a user by user id.
     *
     * @param string $userId
     * @return FollowMessage|Promise<FollowMessage>
     */
    public function unfollow(string $userId)
    {
        return task(function () use ($userId): Promise {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            /**
             * @var GenericRequest $request
             */
            // @phan-suppress-next-line PhanPluginPrintfVariableFormatString
            $request = request(sprintf(self::$URI_UNFOLLOW, $userId), new FollowMessage())(
                $this,
                $this->session,
                $this->client
            );

            // Prepare the request payload
            $request
                ->addCSRFTokenAndUserId()
                ->addUuid()
                ->addPayloadParam('user_id', $userId)
                ->setSerializerType(SerializerFactory::SIGNED);

            // Invoke the request
            return $request->fire();
        })($this->getMode());
    }

    /**
     * Returns a list of followers.
     *
     * @param string      $userId
     * @param string|null $maxId
     * @return FollowersMessage|Promise<FollowersMessage>
     */
    public function followers(string $userId, ?string $maxId = null)
    {
        return task(function () use ($userId, $maxId): Promise {
            /**
             * @var GenericRequest $request
             */
            // @phan-suppress-next-line PhanPluginPrintfVariableFormatString
            $request = request(sprintf(self::$URI_FOLLOWERS, $userId), (new FollowersMessage())->setUserId($userId), 'GET')(
                $this,
                $this->session,
                $this->client
            );

            // Prepare the request payload
            $request
                ->addRankedToken()
                ->addQueryParamIfNotNull('max_id', $maxId);

            // Invoke the request
            return $request->fire();
        })($this->getMode());
    }

    /**
     * Returns a list of following users.
     *
     * @param string      $userId
     * @param null|string $maxId
     * @return FollowingMessage|Promise<FollowingMessage>
     */
    public function following(string $userId, ?string $maxId = null)
    {
        return task(function () use ($userId, $maxId): Promise {
            /**
             * @var GenericRequest $request
             */
            // @phan-suppress-next-line PhanPluginPrintfVariableFormatString
            $request = request(sprintf(self::$URI_FOLLOWING, $userId), (new FollowingMessage())->setUserId($userId), 'GET')(
                $this,
                $this->session,
                $this->client
            );

            // Prepare the request payload
            $request
                ->addRankedToken()
                ->addQueryParamIfNotNull('max_id', $maxId);

            // Invoke the request
            return $request->fire();
        })($this->getMode());
    }
}
