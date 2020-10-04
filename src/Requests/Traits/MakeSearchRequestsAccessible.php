<?php

namespace Instagram\SDK\Requests\Traits;

use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Messages\Search\HashtagSearchResultMessage;
use Instagram\SDK\DTO\Messages\Search\SearchResultMessage;
use Instagram\SDK\DTO\Messages\Search\UserSearchResultMessage;
use Instagram\SDK\Support\Promise;

/**
 * Trait MakeSearchRequestsAccessible
 *
 * @package Instagram\SDK\Requests\Traits
 */
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
     * @return HashtagSearchResultMessage|Promise
     * @throws \Exception
     */
    public function searchByHashtag(string $tag)
    {
        return $this->search(self::$TYPE_SEARCH_HASHTAG, $tag);
    }

    /**
     * Search by user.
     *
     * @param string $user
     * @return UserSearchResultMessage|Promise
     * @throws \Exception
     */
    public function searchByUser(string $user)
    {
        return $this->search(self::$TYPE_SEARCH_USER, $user);
    }

    /**
     * Search the feed by query and type.
     *
     * @param int    $type
     * @param string $query
     * @return SearchResultMessage|Promise<SearchResultMessage>
     * @throws \Exception
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
