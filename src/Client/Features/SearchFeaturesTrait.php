<?php

declare(strict_types=1);

namespace Instagram\SDK\Client\Features;

use GuzzleHttp\Promise\Create;
use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Exceptions\InstagramException;
use Instagram\SDK\Response\Responses\Search\HashtagSearchResultResponse;
use Instagram\SDK\Response\Responses\Search\SearchResultResponse;
use Instagram\SDK\Response\Responses\Search\UserSearchResultResponse;
use const Instagram\SDK\TYPE_HASHTAG;
use const Instagram\SDK\TYPE_USER;

/**
 * Trait SearchFeaturesTrait
 *
 * @package            Instagram\SDK\Client\Features
 * @phan-file-suppress PhanUnreferencedUseNormal
 */
trait SearchFeaturesTrait
{

    use DefaultFeaturesTrait;

    /**
     * Search by hashtag.
     *
     * @param string $hashTag
     * @return PromiseInterface<SearchResultResponse|InstagramException>
     */
    public function searchByHashtag(string $hashTag): PromiseInterface
    {
        return $this->search(TYPE_HASHTAG, $hashTag);
    }

    /**
     * Search by user.
     *
     * @param string $userName
     * @return PromiseInterface<SearchResultResponse|InstagramException>
     */
    public function searchByUser(string $userName): PromiseInterface
    {
        return $this->search(TYPE_USER, $userName);
    }

    /**
     * Search for hashtag.
     *
     * @param int    $type
     * @param string $query
     * @return PromiseInterface<SearchResultResponse|InstagramException>
     */
    public function search(int $type, string $query): PromiseInterface
    {
        switch ($type) {
            case TYPE_HASHTAG:
                $result = $this->querySearch('tags/search/', $query, HashtagSearchResultResponse::class);
                break;
            case TYPE_USER:
                $result = $this->querySearch('users/search/', $query, UserSearchResultResponse::class);
                break;
            default:
                $result = $this->getInvalidSearchTypeError();
                break;
        }

        return $result;
    }

    /**
     * Queries for the search result.
     *
     * @param string $uri
     * @param string $query
     * @param string $responseClass
     * @return PromiseInterface<SearchResultResponse>
     */
    protected function querySearch(string $uri, string $query, string $responseClass): PromiseInterface
    {
        $message = $responseClass::of($query = rawurlencode($query));

        $request = $this->buildRequest($uri, $message, 'GET')
            ->addRankedToken($this->session)
            ->addQueryParam('q', $query)
            ->addQueryParam('is_typeahead', true);

        return $this->call($request);
    }

    /**
     * Returns the invalid type error.
     *
     * @return PromiseInterface
     */
    protected function getInvalidSearchTypeError(): PromiseInterface
    {
        // @phan-suppress-next-line PhanDeprecatedFunction
        return Create::rejectionFor('Invalid search type type provided');
    }
}
