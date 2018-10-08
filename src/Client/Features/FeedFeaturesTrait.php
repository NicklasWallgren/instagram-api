<?php

namespace Instagram\SDK\Client\Features;

use Exception;
use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\DTO\Messages\Feed\FeedMessage;
use Instagram\SDK\Instagram;
use Instagram\SDK\Support\Promise;
use function Instagram\SDK\Support\Promises\rejection_for;
use function Instagram\SDK\Support\Promises\task;
use function Instagram\SDK\Support\request;

/**
 * Trait FeedFeaturesTrait
 *
 * @package Instagram\SDK\Client\Features
 */
trait FeedFeaturesTrait
{

    use DefaultFeaturesTrait;

    /**
     * @var int The hashtag feed type
     */
    public static $TYPE_HASHTAG = 1;

    /**
     * @var int The user feed type
     */
    public static $TYPE_USER = 2;

    /**
     * @var string The hashtag feed endpoint
     */
    private static $ENDPOINT_HASHTAG_FEED = 'feed/tag/%s/';

    /**
     * @var string The user feed endpoint
     */
    private static $ENDPOINT_USER_FEED = 'feed/user/%s/';

    /**
     * Retrieves feed by hashtag.
     *
     * @param string $tag
     * @return FeedMessage|Promise<FeedMessage>
     * @throws Exception
     */
    public function feedByHashtag(string $tag)
    {
        return $this->feed(self::$TYPE_HASHTAG, $tag);
    }

    /**
     * Retrieves feed by user.
     *
     * @param string $user
     * @return FeedMessage|Promise<FeedMessage>
     * @throws Exception
     */
    public function feedByUser(string $user)
    {
        return $this->feed(self::$TYPE_USER, $user);
    }

    /**
     * Retrieves the feed for a specified hashtag.
     *
     * @param int         $type
     * @param string      $query
     * @param string|null $maxId
     * @return FeedMessage|Promise<FeedMessage>
     * @throws Exception
     */
    public function feed(int $type, string $query, ?string $maxId = null)
    {
        switch ($type) {
            case self::$TYPE_HASHTAG:
                $result = $this->queryFeed($type, self::$ENDPOINT_HASHTAG_FEED, $query, FeedMessage::class, $maxId);

                break;
            case self::$TYPE_USER:
                $result = $this->queryFeed($type, self::$ENDPOINT_USER_FEED, $query, FeedMessage::class, $maxId);

                break;
            default:
                $result = $this->getInvalidFeedTypeError();

                break;
        }

        return $result;
    }

    /**
     * Queries for the feed result.
     *
     * @param int         $type
     * @param string      $uri
     * @param string      $query
     * @param string      $result
     * @param string|null $maxId
     * @return FeedMessage|Promise <SearchResultMessage>
     */
    protected function queryFeed(int $type, string $uri, string $query, string $result, ?string $maxId)
    {
        // Prepare the tag query
        $tag = rawurlencode($query);

        return task(function () use ($type, $uri, $tag, $maxId, $result): Promise {
            $message = new $result();
            $message->setQuery($tag);
            $message->setType($type);

            // Build the request instance
            $request = request(sprintf($uri, $tag), $message)(
                $this,
                $this->session,
                $this->client
            );

            // Prepare the request parameters
            $request->addParam('max_id', $maxId);

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
    protected function getInvalidFeedTypeError(): PromiseInterface
    {
        if ($this->getMode() === Instagram::MODE_PROMISE) {
            return rejection_for('Invalid type provided');
        }

        throw new Exception('Invalid type provided');
    }
}
