<?php

namespace Instagram\SDK\DTO\Messages\User;

use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\Session\Session;

/**
 * Class SessionMessage
 *
 * @package Instagram\SDK\DTO\Messages\User
 */
class SessionMessage extends Envelope
{

    /**
     * The logged in user property.
     *
     * @var \Instagram\SDK\DTO\Session\User
     */
    private $loggedInUser;

    /**
     * @var Session
     */
    private $session;

    /**
     * Returns the logged in user.
     *
     * @return \Instagram\SDK\DTO\Session\User
     */
    public function getLoggedInUser()
    {
        return $this->loggedInUser;
    }

    /**
     * @return Session
     */
    public function getSession(): Session
    {
        return $this->session;
    }

    /**
     * @param Session $session
     * @return static
     */
    public function setSession(Session $session)
    {
        $this->session = $session;

        return $this;
    }
}
