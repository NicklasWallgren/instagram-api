<?php

namespace Instagram\SDK\Requests\Exceptions;

use Exception;

/**
 * Class EncodingException
 *
 * @package Instagram\SDK\Requests\Exceptions
 */
final class EncodingException extends Exception
{

    /**
     * EncodingException constructor.
     *
     * @param string $message
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }
}
