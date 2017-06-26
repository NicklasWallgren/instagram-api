<?php

namespace NicklasW\Instagram\Responses\Traits;

use Exception;
use NicklasW\Instagram\DTO\Envelope;
use NicklasW\Instagram\DTO\General\ResponseErrorTypes;
use NicklasW\Instagram\Responses\Exceptions\BadPasswordException;
use NicklasW\Instagram\Responses\Exceptions\ApiResponseException;
use NicklasW\Instagram\Responses\Exceptions\InvalidUserException;
use NicklasW\Instagram\Responses\Exceptions\RateLimitException;

trait ErrorTypeMethodsTrait
{

    /**
     * Creates a exception based on the error type.
     *
     * @param string   $type
     * @param Envelope $envelope
     * @return Exception
     */
    public function toException(?string $type, Envelope $envelope): Exception
    {
        $exception = null;

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
