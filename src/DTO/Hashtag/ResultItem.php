<?php

namespace Instagram\SDK\DTO\Hashtag;

use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Interactive;
use Instagram\SDK\DTO\Messages\Feed\FeedMessage;
use Instagram\SDK\Responses\Serializers\Interfaces\OnItemDecodeInterface;
use Instagram\SDK\Responses\Serializers\Traits\OnPropagateDecodeEventTrait;
use Instagram\SDK\Support\Promise;
use const Instagram\SDK\Client\Features\TYPE_HASHTAG;

/**
 * Class ResultItem
 *
 * @package Instagram\SDK\DTO\Hashtag
 */
class ResultItem extends Interactive implements OnItemDecodeInterface
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
     * @throws \Exception
     */
    public function getFeed()
    {
        return $this->client->feed(TYPE_HASHTAG, $this->name);
    }

    /**
     * On item decode method.
     *
     * @suppress PhanUnusedPublicMethodParameter
     * @suppress PhanPossiblyNullTypeMismatchProperty
     * @param array<string, mixed> $container
     */
    public function onDecode(array $container): void
    {
        $this->client = $container['client'];

        $this->propagate($container);
    }
}
