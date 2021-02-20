<?php

namespace Instagram\SDK\Responses\Serializers;

use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Envelope;

/**
 * Class Serializer
 *
 * @package Instagram\SDK\Responses\Serializers
 */
final class Serializer extends AbstractSerializer
{

    /**
     * @var Client
     */
    private $client;

    /**
     * @var Envelope
     */
    private $envelope;

    /**
     * Serializer constructor.
     *
     * @param Client   $client
     * @param Envelope $envelope
     */
    public function __construct(Client $client, Envelope $envelope)
    {
        $this->client = $client;
        $this->envelope = $envelope;
    }

    // TODO, on decode propagate? pass reader context?

    /**
     * Returns the message implementation.
     *
     * @return Envelope
     */
    protected function message(): Envelope
    {
        return $this->envelope;
    }

}
