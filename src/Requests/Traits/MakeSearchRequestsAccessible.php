<?php

namespace Instagram\SDK\Requests\Traits;

use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Messages\Search\SearchResultMessage;
use Instagram\SDK\Support\Promise;

trait MakeSearchRequestsAccessible
{

    /**
     * @var int The hashtag search type
     */
    public static $TYPE_SEARCH_HASHTAG = 1;

    /**
     * @var int The user search type
     */
    public static $TYPE_SEARCH_USER = 2;

    /**
     * Search by hashtag.
     *
     * @param string $tag
     * @return SearchResultMessage|Promise
     */
    public function searchByHashtag(string $tag)
    {
        return $this->search(self::$TYPE_SEARCH_HASHTAG, $tag);
    }

    /**
     * Search by user.
     *
     * @param string $user
     * @return SearchResultMessage|Promise
     */
    public function searchByUser(string $user)
    {
        return $this->search(self::$TYPE_SEARCH_USER, $user);
    }

    /**
     * Search the feed by query and type.
     *
     * @param string $query
     * @param int    $type
     * @return SearchResultMessage|Promise<SearchResultMessage>
     */
    public function search(int $type, string $query)
    {
        return $this->getClient()->search($type, $query);
    }

    /**
     * Returns the client.
     *
     * @return Client
     */
    abstract protected function getClient(): Client;
}
