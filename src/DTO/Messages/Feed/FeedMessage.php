<?php

namespace Instagram\SDK\DTO\Messages\Feed;

use Exception;
use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\Interfaces\PropertiesInterface;
use Instagram\SDK\DTO\Traits\Inflatable;
use Instagram\SDK\DTO\Traits\PropertiesTrait;
use Instagram\SDK\Responses\Interfaces\IteratorInterface;
use Instagram\SDK\Support\Promise;
use function Instagram\SDK\Support\Promises\task;
use function Instagram\SDK\Support\Promises\unwrap;

/**
 * Class FeedMessage
 *
 * @package Instagram\SDK\DTO\Messages\Feed
 */
class FeedMessage extends Envelope implements IteratorInterface, PropertiesInterface
{

    use Inflatable;
    use PropertiesTrait;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var \Instagram\SDK\DTO\Hashtag\Item[]
     * @name ranked_items
     */
    protected $rankedItems = [];

    /**
     * @var \Instagram\SDK\DTO\Hashtag\Item[]
     */
    protected $items = [];

    /**
     * @var int
     * @name num_results
     */
    protected $numResults;

    /**
     * @var string[]
     */
    protected $previousMaxIds = [];

    /**
     * @var string
     * @name next_max_id
     */
    protected $nextMaxId;

    /**
     * @var bool
     * @name more_available
     */
    protected $moreAvailable;

    /**
     * @var bool
     * @name auto_load_more_enabled
     */
    protected $autoLoadMoreEnabled;

    /**
     * @var string
     */
    protected $query;

    /**
     * @var int
     */
    protected $type;

    /**
     * @return \Instagram\SDK\DTO\Hashtag\Item[]
     */
    public function getRankedItems(): array
    {
        return $this->rankedItems;
    }

    /**
     * @return \Instagram\SDK\DTO\Hashtag\Item[]
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
     * @param mixed $rankedItems
     * @return static
     */
    public function setRankedItems($rankedItems)
    {
        $this->rankedItems = $rankedItems;

        return $this;
    }

    /**
     * @param \Instagram\SDK\DTO\Hashtag\Item[] $items
     * @return static
     */
    public function setItems(array $items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @param mixed $numResults
     * @return static
     */
    public function setNumResults($numResults)
    {
        $this->numResults = $numResults;

        return $this;
    }

    /**
     * @param string[] $previousMaxIds
     * @return static
     */
    public function setPreviousMaxIds(array $previousMaxIds)
    {
        $this->previousMaxIds = $previousMaxIds;

        return $this;
    }

    /**
     * @param mixed $nextMaxId
     * @return static
     */
    public function setNextMaxId($nextMaxId)
    {
        $this->nextMaxId = $nextMaxId;

        return $this;
    }

    /**
     * @param mixed $moreAvailable
     * @return static
     */
    public function setMoreAvailable($moreAvailable)
    {
        $this->moreAvailable = $moreAvailable;

        return $this;
    }

    /**
     * @param mixed $autoLoadMoreEnabled
     * @return static
     */
    public function setAutoLoadMoreEnabled($autoLoadMoreEnabled)
    {
        $this->autoLoadMoreEnabled = $autoLoadMoreEnabled;

        return $this;
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @param string $query
     * @return static
     */
    public function setQuery(string $query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     * @return static
     */
    public function setType(int $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Retrieves the next items in the collection.
     *
     * @suppress PhanPluginUnknownClosureReturnType
     * @return bool|Promise<bool>
     */
    public function next()
    {
        // @phan-suppress-next-line PhanPluginUnknownClosureReturnType
        $promise = task(function () {
            // Check whether the are any more items to be fetched
            if (!$this->moreAvailable) {
                return false;
            }

            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            return $this->client->feed($this->type, $this->query, $this->nextMaxId);
        });

        // @phan-suppress-next-line PhanPluginUnknownClosureParamType, PhanPluginUnknownClosureReturnType
        return $promise->then(function ($promise) {
            $message = unwrap($promise);

            // Check if the message was successful
            if (!$message->isSuccess()) {
                return false;
            }

            // Update the feed message
            $this->inflate($message);

            return true;
        })($this->client->getMode());
    }

    /**
     * @return bool
     */
    public function rewind()
    {
        // TODO

        return false;
    }

    /**
     * Returns the client.
     *
     * @return Client
     */
    protected function getClient(): Client
    {
        return $this->client;
    }

    /**
     * On item decode method.
     *
     * @suppress PhanUnusedPublicMethodParameter
     * @suppress PhanPossiblyNullTypeMismatchProperty
     * @param array $container
     * @param array $requirements
     * @throws Exception
     */
    public function onDecode(array $container, $requirements = []): void
    {
        $this->client = $container['client'];

        $this->propagate($container);
    }
}
