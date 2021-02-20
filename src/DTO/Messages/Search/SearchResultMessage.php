<?php

namespace Instagram\SDK\DTO\Messages\Search;

use Exception;
use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\Requests\Traits\MakeRequestsAccessible;

/**
 * Class SearchResultMessage
 *
 * @package Instagram\SDK\DTO\Messages\Search
 */
abstract class SearchResultMessage extends Envelope
{

    use MakeRequestsAccessible;

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
     */
    protected $hasMore;

    /**
     * @var string
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
     * @return mixed
     */
    public function getRankToken()
    {
        return $this->rankToken;
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
     * @param array<string, mixed> $container
     * @throws Exception
     */
    public function onDecode(array $container): void
    {
        $this->client = $container['client'];

        $this->propagate($container);
    }
}
