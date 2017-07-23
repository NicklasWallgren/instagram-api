<?php

namespace Instagram\SDK\Requests\Traits;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Messages\Hashtag\FeedMessage;
use Instagram\SDK\DTO\Messages\Hashtag\SearchResultMessage;
use Instagram\SDK\Instagram;
use Instagram\SDK\Support\Promise;
use function Instagram\SDK\Support\Promises\rejection_for;

trait MakeFeedRequestsAccessible
{

    /**
     * @var int The hashtag type
     */
    public static $FEED_TYPE_HASHTAG = 1;

    /**
     * Search the feed by query and type.
     *
     * @param string $query
     * @param int    $type
     * @return SearchResultMessage|Promise<SearchResultMessage>
     */
    public function search(string $query, $type)
    {
        $result = null;

        // TODO, implement user/location search

        switch ($type) {
            case self::$FEED_TYPE_HASHTAG:
                $result = $this->getClient()->searchByHashtag($query);

                break;
            default:
                $result = $this->getInvalidTypeError();

                break;
        }

        return $result;
    }

    /**
     * Retrieves feed by type.
     *
     * @param string      $code
     * @param int         $type
     * @param string|null $maxId
     * @return FeedMessage|Promise<FeedMessage>
     */
    public function feed(string $code, $type, ?string $maxId = null)
    {
        $result = null;

        // TODO, implement user/location feed

        switch ($type) {
            case self::$FEED_TYPE_HASHTAG:
                $result = $this->getClient()->hashtagFeed($code, $maxId);

                break;
            default:
                $result = $this->getInvalidTypeError();

                break;
        }

        return $result;
    }

    /**
     * Retrieves related hashtags.
     *
     * @param string $tag
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function related(string $tag)
    {
        // TODO, implement

        return $this->getClient()->related($tag);
    }

    /**
     * Returns the invalid type error.
     *
     * @return PromiseInterface
     * @throws \Exception
     */
    protected function getInvalidTypeError()
    {
        if ($this->getClient()->getMode() === Instagram::MODE_PROMISE) {
            return rejection_for('Invalid type provided');
        }

        throw new \Exception('Invalid type provided');
    }

    /**
     * Returns the client.
     *
     * @return Client
     */
    abstract protected function getClient(): Client;
}
