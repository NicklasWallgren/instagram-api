<?php

namespace Instagram\SDK\Responses\Exceptions;

use Exception;

/**
 * Class InvalidResponseException
 *
 * @package Instagram\SDK\Responses\Exceptions
 */
class InvalidResponseException extends Exception
{

    /**
     * @var string The default error message
     */
    const DEFAULT_MESSAGE = 'Invalid response';

    /**
     * InvalidResponseException constructor.
     *
     * @param string $message
     */
    public function __construct(string $message = self::DEFAULT_MESSAGE)
    {
        parent::__construct($message, 0, null);
    }
}
