<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Responses\User;

use Instagram\SDK\Response\DTO\Session\User;
use Instagram\SDK\Response\Responses\ResponseEnvelope;
use Instagram\SDK\Session\Session;

/**
 * Class SessionResponse
 *
 * @package Instagram\SDK\Response\Responses\User
 */
final class SessionResponse extends ResponseEnvelope
{

    /** @var User|null */
    private $loggedInUser;

    /** @var Session|null */
    private $session;

    /**
     * @return User|null
     */
    public function getLoggedInUser(): ?User
    {
        return $this->loggedInUser;
    }

    /**
     * @return Session|null
     */
    public function getSession(): ?Session
    {
        return $this->session;
    }
}
