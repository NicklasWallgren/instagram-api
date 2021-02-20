<?php

namespace Instagram\SDK\Responses\Serializers\User;

use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\Interfaces\ResponseMessageInterface;
use Instagram\SDK\DTO\Messages\User\SessionMessage;
use Instagram\SDK\Http\HttpClient;
use Instagram\SDK\Responses\Serializers\AbstractSerializer;
use Instagram\SDK\Session\Session;
use Psr\Http\Message\ResponseInterface as HttpResponseInterface;

/**
 * Class LoginSerializer
 *
 * @package Instagram\SDK\Responses\Serializers\User
 */
class LoginSerializer extends AbstractSerializer
{

    /**
     * @var Session
     */
    private $session;

    /**
     * @var HttpClient
     */
    private $client;

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
     * @suppress PhanTypeMismatchArgument
     * @suppress PhanUndeclaredMethod
     * @param HttpResponseInterface $response
     * @param Client                $client
     * @return ResponseMessageInterface
     * @throws \Exception
     */
    public function decode(HttpResponseInterface $response, Client $client): ResponseMessageInterface
    {
        /**
         * @var SessionMessage $message
         */
        $message = parent::decode($response);

        $this->update($message);

        $message->setSession($this->session);

        return $message;
    }

    /**
     * Update the session with id and token.
     *
     * @param SessionMessage $message
     * @return void
     */
    protected function update(SessionMessage $message)
    {
        $this->session->setUser($message->getLoggedInUser());
    }

    /**
     * Returns the message implementation.
     *
     * @return Envelope
     */
    protected function message(): Envelope
    {
        return new SessionMessage();
    }
}
