<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Responses\Search;

use Instagram\SDK\Response\DTO\Hashtag\ResultItem;

/**
 * Class HashtagSearchResultMessage
 *
 * @package Instagram\SDK\Response\Responses\Search
 */
final class HashtagSearchResultResponse extends SearchResultResponse
{

    /** @var ResultItem[] */
    private $results;

    /**
     * HashtagSearchResultResponse constructor.
     *
     * @param string $query
     */
    public function __construct(string $query)
    {
        parent::__construct($query);
    }

    /**
     * @return ResultItem[]
     */
    public function getResults(): array
    {
        return $this->results;
    }
}
