<?php

namespace Instagram\SDK\DTO\General;

/**
 * Class FriendshipStatus
 *
 * @package Instagram\SDK\DTO\General
 */
class FriendshipStatus
{

    /**
     * @var bool
     * @name following
     */
    protected $following;

    /**
     * @var bool
     * @name is_private
     */
    protected $isPrivate;

    /**
     * @var bool
     * @name incoming_request
     */
    protected $incomingRequest;

    /**
     * @var bool
     * @name outgoing_request
     */
    protected $outgoingRequest;

    /**
     * @var bool
     * @name is_bestie
     */
    protected $isBestie;

    /**
     * Returns following.
     *
     * @return bool
     */
    public function getFollowing(): bool
    {
        return $this->following;
    }

    /**
     * Returns true if private, false otherwise.
     *
     * @return bool
     */
    public function isPrivate(): bool
    {
        return $this->isPrivate;
    }

    /**
     * Returns incoming request.
     *
     * @return bool
     */
    public function getIncomingRequest(): bool
    {
        return $this->incomingRequest;
    }

    /**
     * Returns outgoing request.
     *
     * @return bool
     */
    public function getOutgoingRequest(): bool
    {
        return $this->outgoingRequest;
    }

    /**
     * Returns true if bestie, false otherwise.
     *
     * @return bool
     */
    public function isBestie(): bool
    {
        return $this->isBestie;
    }
}
