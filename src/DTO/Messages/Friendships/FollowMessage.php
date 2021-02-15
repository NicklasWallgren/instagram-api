<?php

namespace Instagram\SDK\DTO\Messages\Friendships;

use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\General\FriendshipStatus;
use Instagram\SDK\Responses\Serializers\Traits\OnPropagateDecodeEventTrait;

/**
 * Class FollowMessage
 *
 * @package Instagram\SDK\DTO\Messages\Friendships
 */
class FollowMessage extends Envelope
{

    use OnPropagateDecodeEventTrait;

    /**
     * @var \Instagram\SDK\DTO\General\FriendshipStatus
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
