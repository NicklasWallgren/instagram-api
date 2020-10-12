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
     */
    protected $following;

    /**
     * @var bool
     */
    protected $isPrivate;

    /**
     * @var bool
     */
    protected $incomingRequest;

    /**
     * @var bool
     */
    protected $outgoingRequest;

    /**
     * @var bool
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
