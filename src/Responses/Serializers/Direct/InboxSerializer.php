<?php

namespace Instagram\SDK\Responses\Serializers\Direct;

use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\Messages\Direct\InboxMessage;
use Instagram\SDK\Responses\Serializers\AbstractSerializer;
use Instagram\SDK\Responses\Serializers\Interfaces\OnDecodeInterface;

/**
 * Class InboxSerializer
 *
 * @package Instagram\SDK\Responses\Serializers\Direct
 */
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
    protected function message(): Envelope
    {
        return new InboxMessage();
    }

    /**
     * On decode method.
     *
     * @param Envelope $message
     * @throws \Exception
     */
    public function onDecode(Envelope &$message): void
    {
        $message->onDecode(['client' => $this->client]);
    }
}
