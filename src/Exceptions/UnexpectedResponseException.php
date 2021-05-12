<?php

declare(strict_types=1);

namespace Instagram\SDK\Exceptions;

/**
 * Class UnexpectedResponseException
 *
 * @package Instagram\SDK\Exceptions
 */
final class UnexpectedResponseException extends InstagramException
{

    /**
     * InvalidResponseException constructor.
     *
     * @param string $message
     */
    public function __construct(string $message)
    {
        parent::__construct($message, 0, null);
    }
}
