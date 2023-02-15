<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Responses\User;

use Instagram\SDK\Response\Responses\ResponseInterface;
use Instagram\SDK\Session\Session;
use Psr\Http\Message\ResponseInterface as HttpResponseInterface;

/**
 * Class AuthenticatedUserResponse
 *
 * @package Instagram\SDK\Response\Responses\User
 */
class AuthenticatedUserResponse implements ResponseInterface
{

    /** @var Session */
    private $session;

    /** @var HttpResponseInterface */
    protected $rawResponse;

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

    /** @inheritdoc */
    public function getRawResponse(): HttpResponseInterface
    {
        return $this->rawResponse;
    }

    /** @inheritdoc */
    public function setRawResponse(HttpResponseInterface $response): ResponseInterface
    {
        $this->rawResponse = $response;

        return $this;
    }
}
