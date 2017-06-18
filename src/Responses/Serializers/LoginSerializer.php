<?php

namespace NicklasW\Instagram\Responses\Serializers;

use NicklasW\Instagram\DTO\Envelope;
use NicklasW\Instagram\DTO\Interfaces\ResponseMessageInterface;
use NicklasW\Instagram\DTO\Messages\SessionMessage;
use NicklasW\Instagram\HttpClients\Client as HttpClient;
use NicklasW\Instagram\Responses\Traits\CsrfTokenRetrieverTrait;
use NicklasW\Instagram\Responses\Traits\SessionIdRetrieverTrait;
use NicklasW\Instagram\Session\Session;
use Psr\Http\Message\ResponseInterface as HttpResponseInterface;

class LoginSerializer extends AbstractSerializer
{

    use SessionIdRetrieverTrait;
    use CsrfTokenRetrieverTrait;

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
     * Returns the message implementation.
     *
     * @return Envelope
     */
    protected function message(): ?Envelope
    {
        return new SessionMessage();
    }

}