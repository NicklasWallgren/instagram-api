<?php

namespace Instagram\SDK\Responses\Exceptions;

use Exception;
use Instagram\SDK\DTO\Envelope;

class InvalidRequestException extends Exception
{

    /**
     * @var string The default error message
     */
    const DEFAULT_MESSAGE = 'Invalid request';

    /**
     * InvalidResponseException constructor.
     */
    public function __construct()
    {
        parent::__construct(self::DEFAULT_MESSAGE, 0, null);
    }
}
