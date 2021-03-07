<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Responses\Feed;

use Exception;
use GuzzleHttp\Promise\Create;
use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Client\Client;
use Instagram\SDK\Exceptions\InstagramException;
use Instagram\SDK\Response\DTO\Hashtag\Item;
use Instagram\SDK\Response\Interfaces\IteratorInterface;
use Instagram\SDK\Response\Responses\ResponseEnvelope;
use Instagram\SDK\Utils\PromiseUtils;

/**
 * Class FeedMessage
 *
 * @package Instagram\SDK\Response\Responses\Feed
 */
final class FeedResponse extends ResponseEnvelope implements IteratorInterface
{

    /** @var Client */
    private $client;

    /** @var Item[] */
    private $rankedItems = [];

    /** @var Item[] */
    private $items = [];

    /** @var int */
    private $numResults;

    /** @var string[] */
    private $previousMaxIds = [];

    /** @var string */
    private $nextMaxId;

    /** @var bool */
    private $moreAvailable;

    /** @var bool */
    private $autoLoadMoreEnabled;

    /** @var string */
    private $query;

    /** @var int */
    private $type;

    /**
     * FeedResponse constructor.
     *
     * @param string $query
     * @param int    $type
     */
    public function __construct(string $query, int $type)
    {
        $this->query = $query;
        $this->type = $type;
    }

    /**
     * @return Item[]
     */
    public function getRankedItems(): array
    {
        return $this->rankedItems;
    }

    /**
     * @return Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return int
     */
    public function getNumResults(): int
    {
        return $this->numResults;
    }

    /**
     * @return string
     */
    public function getNextMaxId(): string
    {
        return $this->nextMaxId;
    }

    /**
     * @return bool
     */
    public function getMoreAvailable(): bool
    {
        return $this->moreAvailable;
    }

    /**
     * @return bool
     */
    public function getAutoLoadMoreEnabled(): bool
    {
        return $this->autoLoadMoreEnabled;
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * Retrieves the next items in the collection.
     *
     * @suppress PhanPluginUnknownClosureReturnType
     * @return FeedResponse|null
     * @throws InstagramException
     */
    public function next(): ?FeedResponse
    {
        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return PromiseUtils::wait($this->nextPromise());
    }

    /**
     * @return PromiseInterface<?FeedResponse|InstagramException>
     */
    public function nextPromise(): PromiseInterface
    {
        // Check whether the are any more items to be fetched
        if (!$this->moreAvailable) {
            return Create::rejectionFor(null);
        }

        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return $this->client->feed($this->type, $this->query, $this->nextMaxId);
    }

    /**
     * @return FeedResponse|null
     * @throws InstagramException
     */
    public function rewind(): ?FeedResponse
    {
        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return PromiseUtils::wait($this->rewindPromise());
    }

    /**
     * @return PromiseInterface<?FeedResponse|null>
     */
    public function rewindPromise(): PromiseInterface
    {
        return Create::rejectionFor('not implemented yet');
    }

    /**
     * On item decode method.
     *
     * @suppress PhanUnusedPublicMethodParameter
     * @suppress PhanPossiblyNullTypeMismatchProperty
     * @param array<string, mixed> $container
     * @throws Exception
     */
    public function onDecode(array $container): void
    {
        $this->client = $container['client'];
    }
}
