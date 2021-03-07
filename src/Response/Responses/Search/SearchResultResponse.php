<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Responses\Search;

use Instagram\SDK\Client\Client;
use Instagram\SDK\Response\DTO\Adapters\OnDecodeContext;
use Instagram\SDK\Response\Responses\ResponseEnvelope;
use Instagram\SDK\Response\Serializers\Interfaces\OnResponseDecodeInterface;

/**
 * Class SearchResultResponse
 *
 * @package Instagram\SDK\Response\Responses\Search
 */
abstract class SearchResultResponse extends ResponseEnvelope implements OnResponseDecodeInterface
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
     * @inheritDoc
     */
    public function onDecode(OnDecodeContext $context): void
    {
        $this->client = $context->getClient();
    }

    /**
     * Creates a new instance of static.
     *
     * @param string $query
     * @return SearchResultResponse
     * @phan-suppress PhanTypeInstantiateAbstractStatic
     */
    public static function of(string $query)
    {
        return new static($query);
    }
}
