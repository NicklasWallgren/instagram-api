<?php

namespace Instagram\SDK\DTO\Messages\Search;

use Instagram\SDK\DTO\Hashtag\ResultItem;

class HashtagMessage extends SearchResultMessage
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
