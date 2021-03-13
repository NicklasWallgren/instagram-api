<?php

namespace Instagram\SDK\Client\Features;

use Exception;
use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\DTO\Messages\User\HashtagSearchResultMessage;
use Instagram\SDK\DTO\Messages\User\SearchResultMessage;
use Instagram\SDK\DTO\Messages\User\UserSearchResultMessage;
use Instagram\SDK\Instagram;
use Instagram\SDK\Requests\GenericRequest;
use Instagram\SDK\Support\Promise;
use function Instagram\SDK\Support\Promises\rejection_for;
use function Instagram\SDK\Support\Promises\task;
use function Instagram\SDK\Support\request;
use const Instagram\SDK\TYPE_HASHTAG;
use const Instagram\SDK\TYPE_USER;

/**
 * Trait SearchFeaturesTrait
 *
 * @package Instagram\SDK\Client\Features
 * @phan-file-suppress PhanUnreferencedUseNormal
 */
trait SearchFeaturesTrait
{

    use DefaultFeaturesTrait;

    /**
     * @var string The hashtag search endpoint
     */
    private static $ENDPOINT_HASHTAG_SEARCH = 'tags/search/';

    /**
     * @var string The user search endpoint
     */
    private static $ENDPOINT_USER_SEARCH = 'users/search/';

    /**
     * Search by hashtag.
     *
     * @param string $tag
     * @return SearchResultMessage|Promise<SearchResultMessage>
     * @throws Exception
     */
    public function searchByHashtag(string $tag)
    {
        return $this->search(TYPE_HASHTAG, $tag);
    }

    /**
     * Search by user.
     *
     * @param string $user
     * @return SearchResultMessage|Promise<SearchResultMessage>
     * @throws Exception
     */
    public function searchByUser(string $user)
    {
        return $this->search(TYPE_USER, $user);
    }

    /**
     * Search for hashtag.
     *
     * @param int    $type
     * @param string $query
     * @return SearchResultMessage|Promise<SearchResultMessage>
     * @throws Exception
     */
    public function search(int $type, string $query)
    {
        switch ($type) {
            case TYPE_HASHTAG:
                $result = $this->querySearch(self::$ENDPOINT_HASHTAG_SEARCH, $query, HashtagSearchResultMessage::class);

                break;
            case TYPE_USER:
                $result = $this->querySearch(self::$ENDPOINT_USER_SEARCH, $query, UserSearchResultMessage::class);

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
     * @return SearchResultMessage|Promise<SearchResultMessage>
     */
    protected function querySearch(string $uri, string $query, string $result)
    {
        // Prepare the tag query
        $query = rawurlencode($query);

        return task(function () use ($uri, $query, $result): Promise {
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

            // Invoke the request
            return $request->fire();
        })($this->getMode());
    }

    /**
     * Returns the invalid type error.
     *
     * @return PromiseInterface
     * @throws Exception
     */
    protected function getInvalidSearchTypeError()
    {
        if ($this->getMode() === Instagram::MODE_PROMISE) {
            return rejection_for('Invalid type provided');
        }

        throw new Exception('Invalid type provided');
    }
}
