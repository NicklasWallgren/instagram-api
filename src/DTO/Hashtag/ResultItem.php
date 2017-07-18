<?php

namespace Instagram\SDK\DTO\Hashtag;

use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Messages\Hashtag\FeedMessage;
use Instagram\SDK\Responses\Serializers\Interfaces\OnItemDecodeInterface;
use Instagram\SDK\Responses\Serializers\Traits\OnPropagateDecodeEventTrait;
use Instagram\SDK\Support\Promise;

class ResultItem implements OnItemDecodeInterface
{

    use OnPropagateDecodeEventTrait;

    /**
     * @var float
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $media_count;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @return float
     */
    public function getId(): float
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getMediaCount(): int
    {
        return $this->media_count;
    }

    /**
     * Returns the hashtag feed.
     *
     * @return FeedMessage|Promise<FeedMessage>
     */
    public function getFeed()
    {
        return $this->client->hashtagFeed($this->name);
    }

    /**
     * On item decode method.
     *
     * @param array $container
     * @param array $requirements
     */
    public function onDecode(array $container, $requirements = []): void
    {
        $this->client = $container['client'];

        $this->propagate($container);
    }
}
