<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Responses\User;

use Instagram\SDK\Response\Responses\ResponseInterface;
use Instagram\SDK\Session\Session;

/**
 * Class AuthenticatedUserResponse
 *
 * @package Instagram\SDK\Response\Responses\User
 */
class AuthenticatedUserResponse implements ResponseInterface
{

    /** @var Session */
    private $session;

    /**
     * AuthenticatedUserResponse constructor.
     *
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @return Session
     */
    public function getSession(): Session
    {
        return $this->session;
    }
}
