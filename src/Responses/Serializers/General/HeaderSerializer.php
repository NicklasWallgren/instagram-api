<?php

namespace Instagram\SDK\Responses\Serializers\General;

use Exception;
use GuzzleHttp\Cookie\CookieJar;
use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\Interfaces\ResponseMessageInterface;
use Instagram\SDK\DTO\Messages\HeaderMessage;
use Instagram\SDK\Http\HttpClient;
use Instagram\SDK\Http\Traits\CookieMethodsTrait;
use Instagram\SDK\Responses\Exceptions\InvalidResponseException;
use Instagram\SDK\Responses\Serializers\AbstractSerializer;
use Psr\Http\Message\ResponseInterface as HttpResponseInterface;

/**
 * Class HeaderSerializer
 *
 * @package Instagram\SDK\Responses\Serializers\General
 */
class HeaderSerializer extends AbstractSerializer
{

    use CookieMethodsTrait;

    /**
     * @var HttpClient
     */
    private $client;

    /**
     * HeaderSerializer constructor.
     *
     * @param HttpClient $client
     */
    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * Decodes the response message.
     *
     * @suppress PhanUndeclaredMethod
     * @param HttpResponseInterface $response
     * @param Client                $client
     * @return ResponseMessageInterface
     * @throws InvalidResponseException
     */
    public function decode(HttpResponseInterface $response, Client $client): ResponseMessageInterface
    {
        if (!self::isExpectedHttpResponse($response)) {
            throw new InvalidResponseException();
        }

        /**
         * @var HeaderMessage $message
         */
        $message = $this->message();

        return $message->setToken($this->getCsrfToken());
    }

    /**
     * Returns the message implementation.
     *
     * @return Envelope
     */
    protected function message(): Envelope
    {
        return new HeaderMessage();
    }

    /**
     * Returns the cookie jar.
     *
     * @return CookieJar
     */
    protected function getCookieJar(): CookieJar
    {
        return $this->client->getCookies();
    }
}
