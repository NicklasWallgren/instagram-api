<?php

namespace Instagram\SDK\DTO\Messages\Feed;

use Exception;
use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\Hashtag\Item;
use Instagram\SDK\Responses\Interfaces\IteratorInterface;
use function GuzzleHttp\Promise\promise_for;
use function GuzzleHttp\Promise\rejection_for;

/**
 * Class FeedMessage
 *
 * @package Instagram\SDK\DTO\Messages\Feed
 */
final class FeedMessage extends Envelope implements IteratorInterface
{

    /**
     * @var Client
     */
    private $client;

    /**
     * @var Item[]
     */
    private $rankedItems = [];

    /**
     * @var Item[]
     */
    private $items = [];

    /**
     * @var int
     */
    private $numResults;

    /**
     * @var string[]
     */
    private $previousMaxIds = [];

    /**
     * @var string
     */
    private $nextMaxId;

    /**
     * @var bool
     */
    private $moreAvailable;

    /**
     * @var bool
     */
    private $autoLoadMoreEnabled;

    /**
     * @var string
     */
    private $query;

    /**
     * @var int
     */
    private $type;

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
     * @return FeedMessage|null
     */
    public function next(): ?FeedMessage
    {
        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return $this->nextPromise()->wait();
    }

    /**
     * @return PromiseInterface<FeedMessage>
     */
    public function nextPromise(): PromiseInterface
    {
        // Check whether the are any more items to be fetched
        if (!$this->moreAvailable) {
            return promise_for(null);
        }

        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return $this->client->feed($this->type, $this->query, $this->nextMaxId);
    }

    /**
     * @return FeedMessage|null
     */
    public function rewind(): ?FeedMessage
    {
        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return $this->rewindPromise()->wait();
    }

    /**
     * @return PromiseInterface<FeedMessage|null>
     */
    public function rewindPromise(): PromiseInterface
    {
        return rejection_for('not implemented yet');
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

        $this->propagate($container);
    }
}
