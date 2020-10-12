<?php

namespace Instagram\SDK\Responses\Exceptions;

use Exception;
use Instagram\SDK\DTO\Envelope;

/**
 * Class ApiResponseException
 *
 * @package Instagram\SDK\Responses\Exceptions
 */
class ApiResponseException extends Exception
{

    /**
     * @var string The default error message
     */
    const DEFAULT_MESSAGE = 'Invalid response';

    /**
     * @var Envelope
     */
    protected $envelope;

    /**
     * InvalidResponseException constructor.
     *
     * @param Envelope $envelope
     */
    public function __construct(Envelope $envelope)
    {
        $this->envelope = $envelope;

        parent::__construct(self::getMessageOrFallback($envelope), 0, null);
    }

    /**
     * @return Envelope
     */
    public function getEnvelope(): Envelope
    {
        return $this->envelope;
    }

    private static function getMessageOrFallback(Envelope $envelope): string
    {
        return $envelope ? $envelope->getMessage() ?? '' : self::DEFAULT_MESSAGE;
    }
}
