<?php

namespace Instagram\SDK\Responses\Serializers\User;

use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\Interfaces\ResponseMessageInterface;
use Instagram\SDK\DTO\Messages\SessionMessage;
use Instagram\SDK\Http\RequestClient;
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
     * @var RequestClient
     */
    protected $client;

    /**
     * LoginSerializer constructor.
     *
     * @param Session       $session
     * @param RequestClient $client
     */
    public function __construct(Session $session, RequestClient $client)
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
        $this->session->setUser($message->getLoggedInUser());
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
