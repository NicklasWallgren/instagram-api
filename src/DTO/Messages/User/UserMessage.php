<?php

namespace Instagram\SDK\DTO\Messages\User;

use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\General\User;

/**
 * Class UserMessage
 *
 * @package Instagram\SDK\DTO\Messages\User
 */
class UserMessage extends Envelope
{

    /**
     * @var User
     */
    protected $user;

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
