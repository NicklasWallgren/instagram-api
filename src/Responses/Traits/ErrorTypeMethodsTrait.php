<?php

namespace Instagram\SDK\Responses\Traits;

use Exception;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\General\ResponseErrorTypes;
use Instagram\SDK\Responses\Exceptions\BadPasswordException;
use Instagram\SDK\Responses\Exceptions\ApiResponseException;
use Instagram\SDK\Responses\Exceptions\InvalidUserException;
use Instagram\SDK\Responses\Exceptions\RateLimitException;

/**
 * Trait ErrorTypeMethodsTrait
 *
 * @package Instagram\SDK\Responses\Traits
 */
trait ErrorTypeMethodsTrait
{

    /**
     * Creates a exception based on the error type.
     *
     * @param string|null $type
     * @param Envelope    $envelope
     * @return Exception
     */
    public function toException(?string $type, Envelope $envelope): Exception
    {
        switch ($type) {
            case ResponseErrorTypes::BAD_PASSWORD:
                $exception = new BadPasswordException($envelope);

                break;

            case ResponseErrorTypes::INVALID_USER:
                $exception = new InvalidUserException($envelope);

                break;

            case ResponseErrorTypes::RATE_LIMIT:
                $exception = new RateLimitException($envelope);

                break;

            default:
                $exception = new ApiResponseException($envelope);

                break;
        }

        return $exception;
    }
}
