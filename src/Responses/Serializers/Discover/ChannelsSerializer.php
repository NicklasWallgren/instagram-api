<?php


namespace NicklasW\Instagram\Responses\Serializers\Discover;

use NicklasW\Instagram\Client\Client;
use NicklasW\Instagram\DTO\Envelope;
use NicklasW\Instagram\DTO\Messages\Discover\ChannelsMessage;
use NicklasW\Instagram\DTO\Messages\Discover\ExploreMessage;
use NicklasW\Instagram\Responses\Serializers\AbstractSerializer;
use NicklasW\Instagram\Responses\Serializers\Interfaces\OnDecodeInterface;

class ChannelsSerializer extends AbstractSerializer implements OnDecodeInterface
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
        return new ChannelsMessage();
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