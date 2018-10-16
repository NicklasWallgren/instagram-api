<?php

namespace Instagram\SDK\DTO\Messages\Search;

use Exception;
use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\Interfaces\PropertiesInterface;
use Instagram\SDK\DTO\Traits\Inflatable;
use Instagram\SDK\DTO\Traits\PropertiesTrait;
use Instagram\SDK\Requests\Traits\MakeRequestsAccessible;

/**
 * Class SearchResultMessage
 *
 * @package Instagram\SDK\DTO\Messages\Search
 */
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
     * @return static
     */
    public function setHasMore($hasMore)
    {
        $this->hasMore = $hasMore;

        return $this;
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
     * @return static
     */
    public function setRankToken($rankToken)
    {
        $this->rankToken = $rankToken;

        return $this;
    }

    /**
     * @param Client $client
     * @return static
     */
    public function setClient(Client $client)
    {
        $this->client = $client;

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
