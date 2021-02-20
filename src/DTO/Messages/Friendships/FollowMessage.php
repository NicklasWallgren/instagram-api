<?php

namespace Instagram\SDK\DTO\Messages\Friendships;

use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\General\FriendshipStatus;

/**
 * Class FollowMessage
 *
 * @package Instagram\SDK\DTO\Messages\Friendships
 */
final class FollowMessage extends Envelope
{

    /**
     * @var FriendshipStatus
     */
    private $friendshipStatus;

    /**
     * @return FriendshipStatus
     */
    public function getFriendshipStatus(): FriendshipStatus
    {
        return $this->friendshipStatus;
    }
}
