<?php

namespace Instagram\SDK\DTO\Hashtag;

use Instagram\SDK\DTO\Interactive;
use Instagram\SDK\DTO\Messages\Feed\FeedMessage;
use Instagram\SDK\Responses\Serializers\Interfaces\OnDecodeInterface;
use Instagram\SDK\Support\Promise;
use const Instagram\SDK\TYPE_HASHTAG;

/**
 * Class ResultItem
 *
 * @package Instagram\SDK\DTO\Hashtag
 */
final class ResultItem extends Interactive implements OnDecodeInterface
{

    /**
     * @var float
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $mediaCount;

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
        return $this->mediaCount;
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
    }
}
