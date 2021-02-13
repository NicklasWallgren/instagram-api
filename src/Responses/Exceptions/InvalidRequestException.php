<?php

namespace Instagram\SDK\Responses\Exceptions;

use Exception;

/**
 * Class InvalidRequestException
 *
 * @package Instagram\SDK\Responses\Exceptions
 */
final class InvalidRequestException extends Exception
{

    /**
     * @var string The default error message
     */
    private const DEFAULT_MESSAGE = 'Invalid request';

    /**
     * InvalidResponseException constructor.
     *
     * @param string|null $message
     */
    public function __construct(?string $message = null)
    {
        parent::__construct($message ?? self::DEFAULT_MESSAGE, 0, null);
    }
}
