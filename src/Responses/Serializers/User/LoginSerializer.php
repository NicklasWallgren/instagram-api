<?php

namespace Instagram\SDK\Responses\Serializers\User;

use Instagram\SDK\DTO\CsrfToken;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\Interfaces\ResponseMessageInterface;
use Instagram\SDK\DTO\Messages\SessionMessage;
use Instagram\SDK\DTO\Session\SessionId;
use Instagram\SDK\Http\Client as HttpClient;
use Instagram\SDK\Responses\Serializers\AbstractSerializer;
use Instagram\SDK\Session\Session;
use Psr\Http\Message\ResponseInterface as HttpResponseInterface;

class LoginSerializer extends AbstractSerializer
{

    /**
     * @var Session
     */
    protected $session;

    /**
     * @var HttpClient
     */
    protected $client;

    /**
     * LoginSerializer constructor.
     *
     * @param Session    $session
     * @param HttpClient $client
     */
    public function __construct(Session $session, HttpClient $client)
    {
        $this->session = $session;
        $this->client = $client;
    }

    /**
     * Decodes the response message.
     *
     * @param HttpResponseInterface $response
     * @return ResponseMessageInterface
     */
    public function decode(HttpResponseInterface $response): ResponseMessageInterface
    {
        $message = parent::decode($response);

        $this->update($response, $message);

        $message->setSession($this->session);

        return $message;
    }

    /**
     * Update the session with id and token.
     *
     * @param HttpResponseInterface $response
     * @param SessionMessage        $message
     */
    protected function update(HttpResponseInterface $response, SessionMessage $message)
    {
        $this->session->setId($this->getSessionId($response));
        $this->session->setCsrfToken($this->getCsrfToken($response));
        $this->session->setCookies($this->client->getCookies());
        $this->session->setUser($message->getLoggedInUser());
    }

    /**
     * Returns the CSRF Token.
     *
     * @return CsrfToken
     */
    protected function getCsrfToken(): CsrfToken
    {
        return new CsrfToken($this->getCookieValue('csrftoken'));
    }

    /**
     * Returns the session id.
     *
     * @return SessionId
     */
    protected function getSessionId(): SessionId
    {
        return new SessionId($this->getCookieValue('sessionid'));
    }

    /**
     * Returns the cookie value.
     *
     * @param string $name
     * @return string|null
     */
    protected function getCookieValue($name): ?string
    {
        // Retrieve the cookie value by cookie name
        if (!$cookie = $this->client->getCookies()->getCookieByName($name)) {
            throw new Exception(sprintf('The cookie %s is missing in the cookie jar', $name));
        }

        return $cookie->getValue();
    }

    /**
     * Returns the message implementation.
     *
     * @return Envelope
     */
    protected function message(): ?Envelope
    {
        return new SessionMessage();
    }
}
