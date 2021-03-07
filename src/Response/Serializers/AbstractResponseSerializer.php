<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Serializers;

use Instagram\SDK\Client\Client;
use Instagram\SDK\Exceptions\ApiResponseException;
use Instagram\SDK\Exceptions\BadPasswordResponseException;
use Instagram\SDK\Exceptions\InstagramException;
use Instagram\SDK\Exceptions\InvalidUserResponseException;
use Instagram\SDK\Exceptions\RateLimitResponseException;
use Instagram\SDK\Exceptions\UnexpectedResponseException;
use Instagram\SDK\Response\DTO\Adapters\OnDecodeContext;
use Instagram\SDK\Response\DTO\General\ResponseErrorTypes;
use Instagram\SDK\Response\Interfaces\ResponseSerializerInterface;
use Instagram\SDK\Response\Responses\ResponseEnvelope;
use Instagram\SDK\Response\Responses\ResponseInterface;
use Instagram\SDK\Response\Serializers\Interfaces\OnResponseDecodeInterface;
use LogicException;
use Psr\Http\Message\ResponseInterface as HttpResponseInterface;
use Tebru\Gson\Gson;

/**
 * Class AbstractSerializer
 *
 * @package Instagram\SDK\Response\Serializers
 */
abstract class AbstractResponseSerializer implements ResponseSerializerInterface
{

    protected const STATUS_SUCCESS = 200;
    protected const STATUS_ERROR = 400;
    protected const HTTP_NOT_FOUND = 404;

    /**
     * Decodes the response message.
     *
     * @param HttpResponseInterface $response
     * @param Client                $client
     * @return ResponseInterface
     * @throws InstagramException|LogicException
     */
    public function decode(HttpResponseInterface $response, Client $client): ResponseInterface
    {
        if (!self::isExpectedHttpResponse($response)) {
            self::handleUnexpectedHttpResponse($response);
        }

        $responseInstance = $this->response();

        $gson = Gson::builder()
            ->setReaderContext(new OnDecodeContext($client))
            ->build();

        $gson->fromJson((string)$response->getBody(), $responseInstance);

        if (!self::isValidResponse($responseInstance)) {
            throw $this->toException($responseInstance->getErrorType(), $responseInstance);
        }

        if ($response instanceof OnResponseDecodeInterface) {
            $response->onDecode(new OnDecodeContext($client));
        }

        return $responseInstance;
    }

    /**
     * Returns the {@link ResponseEnvelope} instance.
     *
     * @return ResponseEnvelope
     */
    abstract protected function response();

    /**
     * Check whether we retrieved a expected HTTP response, false otherwise.
     *
     * @param HttpResponseInterface $response
     * @return bool
     */
    private static function isExpectedHttpResponse(HttpResponseInterface $response): bool
    {
        return $response->getStatusCode() === static::STATUS_SUCCESS ||
            $response->getStatusCode() === static::STATUS_ERROR;
    }

    /**
     * Handle invalid HTTP response.
     *
     * @param HttpResponseInterface $response
     * @throws UnexpectedResponseException
     */
    private static function handleUnexpectedHttpResponse(HttpResponseInterface $response): void
    {
        if ($response->getStatusCode() === static::HTTP_NOT_FOUND) {
            throw new UnexpectedResponseException(
                sprintf('Http status 404. Error: %s', (string)$response->getBody()->getContents())
            );
        }

        throw new UnexpectedResponseException(sprintf('Retrieved unexpected response %s', $response->getBody()));
    }

    /**
     * Returns true if we retrieved a valid response, false otherwise.
     *
     * @param ResponseEnvelope $envelope
     * @return bool
     */
    private static function isValidResponse(ResponseEnvelope $envelope): bool
    {
        return $envelope->isSuccess();
    }

    /**
     * Creates a exception based on the error type.
     *
     * @param string|null      $type
     * @param ResponseEnvelope $envelope
     * @return ApiResponseException
     */
    private static function toException(?string $type, ResponseEnvelope $envelope): ApiResponseException
    {
        switch ($type) {
            case ResponseErrorTypes::BAD_PASSWORD:
                $exception = new BadPasswordResponseException($envelope);
                break;
            case ResponseErrorTypes::INVALID_USER:
                $exception = new InvalidUserResponseException($envelope);
                break;
            case ResponseErrorTypes::RATE_LIMIT:
                $exception = new RateLimitResponseException($envelope);
                break;
            default:
                $exception = new ApiResponseException($envelope);
                break;
        }

        return $exception;
    }
}
