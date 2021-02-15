<?php

declare(strict_types=1);

namespace Instagram\SDK\Client\Features;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\DTO\Messages\Search\HashtagSearchResultMessage;
use Instagram\SDK\DTO\Messages\Search\SearchResultMessage;
use Instagram\SDK\DTO\Messages\Search\UserSearchResultMessage;
use Instagram\SDK\Requests\GenericRequest;
use Instagram\SDK\Support\Promise;
use function Instagram\SDK\Support\Promises\rejection_for;
use function Instagram\SDK\Support\request;

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
     * @param string $tag
     * @return Promise<SearchResultMessage>
     */
    public function searchByHashtag(string $tag): PromiseInterface
    {
        return $this->search(TYPE_HASHTAG, $tag);
    }

    /**
     * Search by user.
     *
     * @param string $user
     * @return PromiseInterface<SearchResultMessage>
     */
    public function searchByUser(string $user): PromiseInterface
    {
        return $this->search(TYPE_USER, $user);
    }

    /**
     * Search for hashtag.
     *
     * @param int    $type
     * @param string $query
     * @return PromiseInterface<SearchResultMessage>
     */
    public function search(int $type, string $query): PromiseInterface
    {
        switch ($type) {
            case TYPE_HASHTAG:
                $result = $this->querySearch('tags/search/', $query, HashtagSearchResultMessage::class);
                break;
            case TYPE_USER:
                $result = $this->querySearch('users/search/', $query, UserSearchResultMessage::class);
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
     * @param string $result
     * @return PromiseInterface<SearchResultMessage>
     */
    protected function querySearch(string $uri, string $query, string $result): PromiseInterface
    {
        // Prepare the tag query
        $query = rawurlencode($query);

        $message = new $result();
        $message->setQuery($query);

        /** @var GenericRequest $request */
        $request = request($uri, $message, 'GET')(
            $this,
            $this->session,
            $this->client
        );

        $request
            ->addRankedToken()
            ->addQueryParam('q', $query)
            ->addQueryParam('is_typeahead', true);

        return $request->fire();
    }

    /**
     * Returns the invalid type error.
     *
     * @return PromiseInterface
     */
    protected function getInvalidSearchTypeError(): PromiseInterface
    {
        return rejection_for('Invalid type provided');
    }
}
