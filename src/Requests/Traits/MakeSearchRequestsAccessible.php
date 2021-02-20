<?php

namespace Instagram\SDK\Requests\Traits;

use Exception;
use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Messages\Search\HashtagSearchResultMessage;
use Instagram\SDK\DTO\Messages\Search\SearchResultMessage;
use Instagram\SDK\DTO\Messages\Search\UserSearchResultMessage;
use const Instagram\SDK\TYPE_HASHTAG;
use const Instagram\SDK\TYPE_USER;

/**
 * Trait MakeSearchRequestsAccessible
 *
 * @package Instagram\SDK\Requests\Traits
 */
trait MakeSearchRequestsAccessible
{

    /**
     * Search by hashtag.
     *
     * @param string $tag
     * @return HashtagSearchResultMessage
     * @throws Exception
     */
    public function searchByHashtag(string $tag): HashtagSearchResultMessage
    {
        return $this->searchByHashtagPromise($tag)->wait();
    }

    /**
     * Search by hashtag.
     *
     * @param string $tag
     * @return PromiseInterface<HashtagSearchResultMessage>
     */
    public function searchByHashtagPromise(string $tag): PromiseInterface
    {
        return $this->searchPromise(TYPE_HASHTAG, $tag);
    }

    /**
     * Search by user.
     *
     * @param string $user
     * @return UserSearchResultMessage
     * @throws Exception
     */
    public function searchByUser(string $user): UserSearchResultMessage
    {
        return $this->searchByUserPromise($user)->wait();
    }

    /**
     * Search by user.
     *
     * @param string $user
     * @return PromiseInterface<UserSearchResultMessage>
     */
    public function searchByUserPromise(string $user): PromiseInterface
    {
        return $this->searchPromise(TYPE_USER, $user);
    }

    /**
     * Search the feed by query and type.
     *
     * @param int    $type
     * @param string $query
     * @return SearchResultMessage
     * @throws Exception
     */
    public function search(int $type, string $query): SearchResultMessage
    {
        return $this->searchPromise($type, $query)->wait();
    }

    /**
     * Search the feed by query and type.
     *
     * @param int    $type
     * @param string $query
     * @return PromiseInterface<SearchResultMessage>
     */
    public function searchPromise(int $type, string $query): PromiseInterface
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
