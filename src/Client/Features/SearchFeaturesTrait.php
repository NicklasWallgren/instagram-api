<?php

namespace Instagram\SDK\Client\Features;

use Exception;
use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\DTO\Messages\Search\HashtagMessage;
use Instagram\SDK\DTO\Messages\Search\SearchResultMessage;
use Instagram\SDK\DTO\Messages\Search\UserMessage;
use Instagram\SDK\Instagram;
use Instagram\SDK\Support\Promise;
use function Instagram\SDK\Support\Promises\rejection_for;
use function Instagram\SDK\Support\Promises\task;
use function Instagram\SDK\Support\request;

trait SearchFeaturesTrait
{

    use DefaultFeaturesTrait;

    /**
     * @var int The hashtag type
     */
    public static $TYPE_HASHTAG = 1;

    /**
     * @var int The user type
     */
    public static $TYPE_USER = 2;

    /**
     * @var string The hashtag search endpoint
     */
    private static $ENDPOINT_HASHTAG_SEARCH = 'tags/search/';

    /**
     * @var string The user search endpoint
     */
    private static $ENDPOINT_USER_SEARCH = 'users/search';

    /**
     * Search by hashtag.
     *
     * @param string $tag
     * @return SearchResultMessage|Promise<SearchResultMessage>
     */
    public function searchByHashtag(string $tag)
    {
        return $this->search(self::$TYPE_HASHTAG, $tag);
    }

    /**
     * Search by user.
     *
     * @param string $user
     * @return SearchResultMessage|Promise<SearchResultMessage>
     */
    public function searchByUser(string $user)
    {
        return $this->search(self::$TYPE_USER, $user);
    }

    /**
     * Search for hashtag.
     *
     * @param int    $type
     * @param string $query
     * @return SearchResultMessage|Promise<SearchResultMessage>
     */
    public function search(int $type, string $query)
    {
        $result = null;

        switch ($type) {
            case self::$TYPE_HASHTAG:
                $result = $this->querySearch(self::$ENDPOINT_HASHTAG_SEARCH, $query, HashtagMessage::class);

                break;
            case self::$TYPE_USER:
                $result = $this->querySearch(self::$ENDPOINT_USER_SEARCH, $query, UserMessage::class);

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

        return task(function () use ($uri, $query, $result) {
            $message = new $result();
            $message->setQuery($query);

            // Build the request instance
            $request = request($uri, $message)($this, $this->session,
                $this->client);

            $request
                ->addRankedToken()
                ->setParam('q', $query)
                ->setParam('is_typeahead', true);

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
