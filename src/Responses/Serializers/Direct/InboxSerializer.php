<?php

namespace NicklasW\Instagram\Responses\Serializers\Direct;

use NicklasW\Instagram\Client\Client;
use NicklasW\Instagram\DTO\Envelope;
use NicklasW\Instagram\DTO\Messages\Direct\InboxMessage;
use NicklasW\Instagram\Responses\Serializers\AbstractSerializer;
use NicklasW\Instagram\Responses\Serializers\Interfaces\OnDecodeInterface;

class InboxSerializer extends AbstractSerializer implements OnDecodeInterface
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * InboxSerializer constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Returns the message implementation.
     *
     * @return Envelope
     */
    protected function message(): ?Envelope
    {
        return new InboxMessage();
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