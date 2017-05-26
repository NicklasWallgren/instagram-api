<?php

namespace NicklasW\Instagram\Responses\Exceptions;

use Exception;
use NicklasW\Instagram\DTO\Envelope;

class InvalidResponseException extends Exception
{

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

        parent::__construct($envelope->getMessage(), 0, null);
    }

    /**
     * @return Envelope
     */
    public function getEnvelope(): Envelope
    {
        return $this->envelope;
    }

}