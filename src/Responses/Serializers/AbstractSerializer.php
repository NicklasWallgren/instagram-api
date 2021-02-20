<?php

namespace Instagram\SDK\Responses\Serializers;

use Exception;
use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Adapters\CustomReaderContext;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\Interfaces\ResponseMessageInterface;
use Instagram\SDK\Responses\Exceptions\ApiResponseException;
use Instagram\SDK\Responses\Exceptions\InvalidRequestException;
use Instagram\SDK\Responses\Interfaces\SerializerInterface;
use Instagram\SDK\Responses\Traits\ErrorTypeMethodsTrait;
use Psr\Http\Message\ResponseInterface as HttpResponseInterface;
use Tebru\Gson\Gson;

/**
 * Class AbstractSerializer
 *
 * @package Instagram\SDK\Responses\Serializers
 */
abstract class AbstractSerializer implements SerializerInterface
{

    use ErrorTypeMethodsTrait;

    protected const STATUS_SUCCESS = 200;
    protected const STATUS_ERROR = 400;
    protected const HTTP_NOT_FOUND = 404;

    /**
     * Decodes the response message.
     *
     * @param HttpResponseInterface $response
     * @param Client                $client
     * @return ResponseMessageInterface
     * @throws Exception
     */
    public function decode(HttpResponseInterface $response, Client $client): ResponseMessageInterface
    {
        if (!self::isExpectedHttpResponse($response)) {
            self::handleUnexpectedHttpResponse($response);
        }

        $message = $this->message();

        $gson = Gson::builder()
            ->setReaderContext(new CustomReaderContext($client))
            ->build();

        $gson->fromJson((string)$response->getBody(), $message);

        if (!self::isValidResponse($message)) {
            throw $this->toException($message->getErrorType(), $message);
        }

        return $message;
    }

    /**
     * Returns the message implementation.
     *
     * @return Envelope
     */
    abstract protected function message(): Envelope;

    /**
     * Check whether we retrieved a expected HTTP response, false otherwise.
     *
     * @param HttpResponseInterface $response
     * @return bool
     */
    protected static function isExpectedHttpResponse(HttpResponseInterface $response): bool
    {
        return $response->getStatusCode() === static::STATUS_SUCCESS ||
            $response->getStatusCode() === static::STATUS_ERROR;
    }

    /**
     * Handle invalid HTTP response.
     *
     * @param HttpResponseInterface $response
     * @throws Exception
     */
    private static function handleUnexpectedHttpResponse(HttpResponseInterface $response): void
    {
        if ($response->getStatusCode() === static::HTTP_NOT_FOUND) {
            throw new InvalidRequestException(
                sprintf('Http status 404. Error: %s', (string)$response->getBody()->getContents())
            );
        }

        throw new ApiResponseException(new Envelope((string)$response->getBody()));
    }

    /**
     * Returns true if we retrieved a valid response, false otherwise.
     *
     * @param Envelope $envelope
     * @return bool
     */
    private static function isValidResponse(Envelope $envelope): bool
    {
        return $envelope->isSuccess();
    }

}
