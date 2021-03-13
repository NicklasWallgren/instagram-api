<?php

namespace Instagram\SDK\DTO\Messages\User;

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
    protected $results;

    /**
     * @return ResultItem[]
     */
    public function getResults(): array
    {
        return $this->results;
    }
}
