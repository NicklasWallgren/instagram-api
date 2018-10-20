<?php

namespace Instagram\SDK\Client\Features;

use Instagram\SDK\DTO\Messages\Friendships\FollowMessage;
use Instagram\SDK\Requests\GenericRequest;
use Instagram\SDK\Requests\Http\Builders\GenericRequestBuilder;
use Instagram\SDK\Support\Promise;
use function Instagram\SDK\Support\Promises\task;
use function Instagram\SDK\Support\request;

/**
 * Trait FriendshipsFeaturesTrait
 *
 * @package Instagram\SDK\Client\Features
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
     * Follow a user by user id.
     *
     * @param string $userId
     * @return FollowMessage|Promise<FollowMessage>
     */
    public function follow(string $userId)
    {
        return task(function () use ($userId): Promise {
            $this->checkPrerequisites();

            /**
             * @var GenericRequest $request
             */
            $request = request(sprintf(self::$URI_FOLLOW, $userId), new FollowMessage())(
                $this,
                $this->session,
                $this->client
            );

            // Prepare the request payload
            $request
                ->addCSRFTokenAndUserId()
                ->addUuid()
                ->setPost('user_id', $userId)
                ->setMode(GenericRequestBuilder::$MODE_SIGNED);

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
            $this->checkPrerequisites();

            /**
             * @var GenericRequest $request
             */
            $request = request(sprintf(self::$URI_UNFOLLOW, $userId), new FollowMessage())(
                $this,
                $this->session,
                $this->client
            );

            // Prepare the request payload
            $request
                ->addCSRFTokenAndUserId()
                ->addUuid()
                ->setPost('user_id', $userId)
                ->setMode(GenericRequestBuilder::$MODE_SIGNED);

            // Invoke the request
            return $request->fire();
        })($this->getMode());
    }
}
