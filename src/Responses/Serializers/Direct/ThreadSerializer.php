<?php

namespace NicklasW\Instagram\Responses\Serializers\Direct;

use NicklasW\Instagram\Client\Client;
use NicklasW\Instagram\DTO\Envelope;
use NicklasW\Instagram\DTO\Messages\Direct\ThreadMessage;
use NicklasW\Instagram\Responses\Serializers\AbstractSerializer;
use NicklasW\Instagram\Responses\Serializers\Interfaces\OnDecodeInterface;

class ThreadSerializer extends AbstractSerializer implements OnDecodeInterface
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * ThreadSerializer constructor.
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
        return new ThreadMessage();
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
