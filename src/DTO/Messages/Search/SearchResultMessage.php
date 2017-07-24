<?php

namespace Instagram\SDK\DTO\Messages\Search;

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

abstract class SearchResultMessage extends Envelope implements PropertiesInterface
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
