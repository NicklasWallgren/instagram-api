<?php


namespace Instagram\SDK\Responses\Serializers\Discover;

use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\Messages\Discover\ExploreMessage;
use Instagram\SDK\Responses\Serializers\AbstractSerializer;
use Instagram\SDK\Responses\Serializers\Interfaces\OnDecodeInterface;

class ExploreSerializer extends AbstractSerializer implements OnDecodeInterface
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
        return new ExploreMessage();
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
