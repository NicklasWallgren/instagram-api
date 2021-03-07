<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Responses\Search;

use Exception;
use Instagram\SDK\Client\Client;
use Instagram\SDK\Response\Responses\ResponseEnvelope;

/**
 * Class SearchResultMessage
 *
 * @package Instagram\SDK\Response\Responses\Search
 */
abstract class SearchResultResponse extends ResponseEnvelope
{

    /** @var Client */
    protected $client;

    /** @var string */
    protected $query;

    /** @var bool */
    protected $hasMore;

    /** @var string */
    protected $rankToken;

    /** @var int */
    protected $numResults;

    /**
     * SearchResultResponse constructor.
     *
     * @param string $query
     */
    public function __construct(string $query)
    {
        $this->query = $query;
    }

    /**
     * @return bool
     */
    public function getHasMore()
    {
        return $this->hasMore;
    }

    /**
     * @return string
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
     * @return int
     */
    public function getNumResults(): int
    {
        return $this->numResults;
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
    }

    /**
     * Creates a new instance of static.
     *
     * @param string $query
     * @return $this
     */
    public function of(string $query)
    {
        return new static($query);
    }
}
