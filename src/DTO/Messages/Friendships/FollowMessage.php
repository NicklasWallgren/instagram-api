<?php

namespace Instagram\SDK\DTO\Messages\Friendships;

use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\General\FriendshipStatus;
use Instagram\SDK\Responses\Serializers\Traits\OnPropagateDecodeEventTrait;
use Traits\MappableTrait;

/**
 * Class FollowMessage
 *
 * @package Instagram\SDK\DTO\Messages\Friendships
 */
class FollowMessage extends Envelope
{

    use MappableTrait;
    use OnPropagateDecodeEventTrait;

    /**
     * @var \Instagram\SDK\DTO\General\FriendshipStatus
     * @name friendship_status
     */
    protected $friendshipStatus;

    /**
     * @return FriendshipStatus
     */
    public function getFriendshipStatus(): FriendshipStatus
    {
        return $this->friendshipStatus;
    }
}
