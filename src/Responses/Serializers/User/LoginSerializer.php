<?php

namespace Instagram\SDK\Responses\Serializers\User;

use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\Interfaces\ResponseMessageInterface;
use Instagram\SDK\DTO\Messages\User\SessionMessage;
use Instagram\SDK\Http\RequestClient;
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
     * @suppress PhanTypeMismatchArgument
     * @suppress PhanUndeclaredMethod
     * @param HttpResponseInterface $response
     * @return ResponseMessageInterface
     * @throws \Exception
     */
    public function decode(HttpResponseInterface $response): ResponseMessageInterface
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
