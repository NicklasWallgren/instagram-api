<?php

namespace Instagram\SDK\DTO\Messages\Feed;

use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\Interfaces\PropertiesInterface;
use Instagram\SDK\DTO\Traits\Inflatable;
use Instagram\SDK\DTO\Traits\PropertiesTrait;
use Instagram\SDK\Requests\Traits\MakeRequestsAccessible;
use Instagram\SDK\Responses\Interfaces\IteratorInterface;
use Instagram\SDK\Support\Promise;
use function Instagram\SDK\Support\Promises\task;
use function Instagram\SDK\Support\Promises\unwrap;

class FeedMessage extends Envelope implements IteratorInterface, PropertiesInterface
{

    use MakeRequestsAccessible;
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
     */
    public function setRankedItems($rankedItems)
    {
        $this->rankedItems = $rankedItems;
    }

    /**
     * @param \Instagram\SDK\DTO\Hashtag\Item[] $items
     */
    public function setItems(array $items)
    {
        $this->items = $items;
    }

    /**
     * @param mixed $numResults
     */
    public function setNumResults($numResults)
    {
        $this->numResults = $numResults;
    }

    /**
     * @param \string[] $previousMaxIds
     */
    public function setPreviousMaxIds(array $previousMaxIds)
    {
        $this->previousMaxIds = $previousMaxIds;
    }

    /**
     * @param mixed $nextMaxId
     */
    public function setNextMaxId($nextMaxId)
    {
        $this->nextMaxId = $nextMaxId;
    }

    /**
     * @param mixed $moreAvailable
     */
    public function setMoreAvailable($moreAvailable)
    {
        $this->moreAvailable = $moreAvailable;
    }

    /**
     * @param mixed $autoLoadMoreEnabled
     */
    public function setAutoLoadMoreEnabled($autoLoadMoreEnabled)
    {
        $this->autoLoadMoreEnabled = $autoLoadMoreEnabled;
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
     */
    public function setQuery(string $query)
    {
        $this->query = $query;
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
     */
    public function setType(int $type)
    {
        $this->type = $type;
    }

    /**
     * Retrieves the next items in the collection.
     *
     * @return bool|Promise<bool>
     */
    public function next()
    {
        $promise = task(function () {
            // Check whether the are any more items to be fetched
            if (!$this->moreAvailable) {
                return false;
            }

            return $this->client->feed($this->query, $this->nextMaxId);
        });

        return $promise->then(function ($promise) {
            $message = unwrap($promise);

            // Check if the message was successful
            if (!$message->isSuccess()) {
                return false;
            }

            // Update the feed message
            $this->inflate($message);

            return true;
        })($this->getMode());
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
     * @param array $container
     * @param array $requirements
     */
    public function onDecode(array $container, $requirements = []): void
    {
        $this->client = $container['client'];

        $this->propagate($container);
    }
}
