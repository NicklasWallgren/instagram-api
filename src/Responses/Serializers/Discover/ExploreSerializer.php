<?php


namespace Instagram\SDK\Responses\Serializers\Discover;

use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\Messages\Discover\ExploreMessage;
use Instagram\SDK\Responses\Serializers\AbstractSerializer;
use Instagram\SDK\Responses\Serializers\Interfaces\OnDecodeInterface;

/**
 * Class ExploreSerializer
 *
 * @package Instagram\SDK\Responses\Serializers\Discover
 */
class ExploreSerializer extends AbstractSerializer implements OnDecodeInterface
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * ExploreSerializer constructor.
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
        return new ExploreMessage();
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
