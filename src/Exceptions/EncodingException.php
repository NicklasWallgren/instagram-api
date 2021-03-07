<?php

declare(strict_types=1);

namespace Instagram\SDK\Exceptions;

/**
 * Class EncodingException
 *
 * @package Instagram\SDK\Exceptions
 */
final class EncodingException extends InstagramException
{

    /**
     * EncodingException constructor.
     *
     * @param string $message
     */
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
