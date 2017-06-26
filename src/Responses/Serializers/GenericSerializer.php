<?php

namespace NicklasW\Instagram\Responses\Serializers;

use NicklasW\Instagram\Client\Client;
use NicklasW\Instagram\DTO\Envelope;
use NicklasW\Instagram\Responses\Serializers\Interfaces\OnDecodeInterface;

class GenericSerializer extends AbstractSerializer implements OnDecodeInterface
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var Envelope
     */
    protected $envelope;

    /**
     * InboxSerializer constructor.
     *
     * @param Client   $client
     * @param Envelope $envelope
     */
    public function __construct(Client $client, Envelope $envelope)
    {
        $this->client = $client;
        $this->envelope = $envelope;
    }

    /**
     * Returns the message implementation.
     *
     * @return Envelope
     */
    protected function message(): ?Envelope
    {
        return $this->envelope;
    }

    /**
     * On decode method.
     *
     * @param Envelope $message
     */
    public function onDecode(Envelope &$message): void
    {
        $message->onDecode(['client' => $this->client]);
    }
}
