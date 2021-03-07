<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Responses\Friendships;

use Instagram\SDK\Response\DTO\General\FriendshipStatus;
use Instagram\SDK\Response\Responses\ResponseEnvelope;

/**
 * Class FollowMessage
 *
 * @package Instagram\SDK\Response\Responses\Friendships
 */
final class FollowResponse extends ResponseEnvelope
{

    /** @var FriendshipStatus */
    private $friendshipStatus;

    /**
     * @return FriendshipStatus
     */
    public function getFriendshipStatus(): FriendshipStatus
    {
        return $this->friendshipStatus;
    }
}
