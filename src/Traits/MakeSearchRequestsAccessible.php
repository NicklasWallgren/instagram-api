<?php

declare(strict_types=1);

namespace Instagram\SDK\Traits;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Client\Client;
use Instagram\SDK\Exceptions\InstagramException;
use Instagram\SDK\Response\Responses\Search\HashtagSearchResultResponse;
use Instagram\SDK\Response\Responses\Search\SearchResultResponse;
use Instagram\SDK\Response\Responses\Search\UserSearchResultResponse;
use Instagram\SDK\Utils\PromiseUtils;
use const Instagram\SDK\TYPE_HASHTAG;
use const Instagram\SDK\TYPE_USER;

/**
 * Trait MakeSearchRequestsAccessible
 *
 * @package Instagram\SDK\Traits
 */
trait MakeSearchRequestsAccessible
{

    /**
     * Search by hashtag.
     *
     * @param string $tag
     * @return HashtagSearchResultResponse
     * @throws InstagramException in case of an error
     */
    public function searchByHashtag(string $tag): HashtagSearchResultResponse
    {
        return PromiseUtils::wait($this->searchByHashtagPromise($tag));
    }

    /**
     * Search by hashtag.
     *
     * @param string $tag
     * @return PromiseInterface<HashtagSearchResultResponse|InstagramException>
     */
    public function searchByHashtagPromise(string $tag): PromiseInterface
    {
        return $this->searchPromise(TYPE_HASHTAG, $tag);
    }

    /**
     * Search by username.
     *
     * @param string $username
     * @return UserSearchResultResponse
     * @throws InstagramException in case of an error
     */
    public function searchByUser(string $username): UserSearchResultResponse
    {
        return PromiseUtils::wait($this->searchByUserPromise($username));
    }

    /**
     * Search by user.
     *
     * @param string $user
     * @return PromiseInterface<UserSearchResultResponse|InstagramException>
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
     * @return SearchResultResponse
     * @throws InstagramException in case of an error
     */
    public function search(int $type, string $query): SearchResultResponse
    {
        return PromiseUtils::wait($this->searchPromise($type, $query));
    }

    /**
     * Search the feed by query and type.
     *
     * @param int    $type
     * @param string $query
     * @return PromiseInterface<SearchResultResponse|InstagramException>
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
