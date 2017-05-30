<?php

namespace NicklasW\Instagram\Responses\Exceptions;

use Exception;
use NicklasW\Instagram\DTO\Envelope;

class InvalidResponseException extends Exception
{

    const DEFAULT_MESSAGE = 'Invalid response';

    /**
     * @var Envelope
     */
    protected $envelope;

    /**
     * InvalidResponseException constructor.
     *
     * @param Envelope|null $envelope
     */
    public function __construct(Envelope $envelope = null)
    {
        $this->envelope = $envelope;

        parent::__construct($envelope? $envelope->getMessage() : self::DEFAULT_MESSAGE, 0, null);
    }

    /**
     * @return Envelope
     */
    public function getEnvelope(): Envelope
    {
        return $this->envelope;
    }

}