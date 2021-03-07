<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\DTO\Hashtag;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Exceptions\InstagramException;
use Instagram\SDK\Response\DTO\Adapters\OnDecodeContext;
use Instagram\SDK\Response\DTO\Interactive;
use Instagram\SDK\Response\Responses\Feed\FeedResponse;
use Instagram\SDK\Response\Serializers\Interfaces\OnResponseDecodeInterface;
use const Instagram\SDK\TYPE_HASHTAG;

/**
 * Class ResultItem
 *
 * @package Instagram\SDK\Response\DTO\Hashtag
 */
final class ResultItem extends Interactive implements OnResponseDecodeInterface
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
     * @return FeedResponse|PromiseInterface<FeedResponse>
     * @throws InstagramException
     */
    public function getFeed()
    {
        return $this->client->feed(TYPE_HASHTAG, $this->name);
    }

    /**
     * @inheritDoc
     */
    public function onDecode(OnDecodeContext $context): void
    {
        $this->client = $context->getClient();
    }
}
