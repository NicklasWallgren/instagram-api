<?php

namespace Instagram\SDK\DTO\Messages\Search;

use Instagram\SDK\DTO\Hashtag\ResultItem;

/**
 * Class HashtagSearchResultMessage
 *
 * @package Instagram\SDK\DTO\Messages\Search
 */
class HashtagSearchResultMessage extends SearchResultMessage
{

    /**
     * @var \Instagram\SDK\DTO\Hashtag\ResultItem[]
     */
    private $results;

    /**
     * @return ResultItem[]
     */
    public function getResults(): array
    {
        return $this->results;
    }
}
