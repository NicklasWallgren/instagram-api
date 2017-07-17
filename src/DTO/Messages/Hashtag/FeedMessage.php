<?php

namespace Instagram\SDK\DTO\Messages\Hashtag;

use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\Interfaces\PropertiesInterface;
use Instagram\SDK\DTO\Traits\Inflatable;
use Instagram\SDK\DTO\Traits\PropertiesTrait;
use Instagram\SDK\Requests\Traits\MakeRequestsAccessible;
use Instagram\SDK\Responses\Interfaces\IteratorInterface;
use Instagram\SDK\Support\Promise;
use function Instagram\SDK\Promises\task;
use function Instagram\SDK\Promises\unwrap;

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
    protected $rankedItems;

    /**
     * @var \Instagram\SDK\DTO\Hashtag\Item[]
     */
    protected $items;

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
     * @param Client $client
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
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
