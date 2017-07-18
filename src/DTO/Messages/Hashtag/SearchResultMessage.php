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

class SearchResultMessage extends Envelope implements IteratorInterface, PropertiesInterface
{

    use MakeRequestsAccessible;
    use Inflatable;
    use PropertiesTrait;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $query;

    /**
     * @var \Instagram\SDK\DTO\Hashtag\ResultItem[]
     */
    protected $results;

    /**
     * @var bool
     * @name has_more
     */
    protected $hasMore;

    /**
     * @var string
     * @name rank_token
     */
    protected $rankToken;

    /**
     * @return \Instagram\SDK\DTO\Hashtag\ResultItem[]
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param \Instagram\SDK\DTO\Hashtag\ResultItem[] $results
     */
    public function setResults($results)
    {
        $this->results = $results;
    }

    /**
     * @return mixed
     */
    public function getHasMore()
    {
        return $this->hasMore;
    }

    /**
     * @param mixed $hasMore
     */
    public function setHasMore($hasMore)
    {
        $this->hasMore = $hasMore;
    }

    /**
     * @return mixed
     */
    public function getRankToken()
    {
        return $this->rankToken;
    }

    /**
     * @param mixed $rankToken
     */
    public function setRankToken($rankToken)
    {
        $this->rankToken = $rankToken;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
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
