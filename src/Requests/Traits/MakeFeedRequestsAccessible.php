<?php

namespace Instagram\SDK\Requests\Traits;

use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Messages\Feed\FeedMessage;
use Instagram\SDK\DTO\Messages\Feed\Timeline;
use Instagram\SDK\Requests\Feed\TimelineOptions;
use Instagram\SDK\Support\Promise;

/**
 * Trait MakeFeedRequestsAccessible
 *
 * @package Instagram\SDK\Requests\Traits
 */
trait MakeFeedRequestsAccessible
{

    /**
     * @var int The hashtag feed type
     */
    public static $TYPE_FEED_HASHTAG = 1;

    /**
     * @var int The user feed type
     */
    public static $TYPE_FEED_USER = 2;

    /**
     * @var int The single feed type
     */
    public static $TYPE_FEED_SINGLE = 3;

    /**
     * Retrieves feed by hashtag.
     *
     * @param  string  $tag
     *
     * @return FeedMessage|Promise
     * @throws \Exception
     */
    public function feedByHashtag(string $tag)
    {
        return $this->feed(self::$TYPE_FEED_HASHTAG, $tag);
    }

    /**
     * Retrieves feed by user.
     *
     * @param  string  $userId
     *
     * @return FeedMessage|Promise
     * @throws \Exception
     */
    public function feedByUser(string $userId)
    {
        return $this->feed(self::$TYPE_FEED_USER, $userId);
    }

    /**
     * Retrieves story by user.
     *
     * @param  string  $userId
     *
     * @return FeedMessage|Promise
     * @throws \Exception
     */
    public function storyByUser(string $userId)
    {
        return $this->story($userId);
    }

    /**
     * Retrieves feed by ID.
     *
     * @param  string  $feedId
     *
     * @return FeedMessage|Promise
     * @throws \Exception
     */
    public function feedByID(string $feedId)
    {
        return $this->feed(self::$TYPE_FEED_SINGLE, $feedId);
    }

    /**
     * Retrieves feed by type.
     *
     * @param  int  $type
     * @param  string  $query
     * @param  string|null  $maxId
     *
     * @return FeedMessage|Promise<FeedMessage>
     * @throws \Exception
     */
    public function feed(int $type, string $query, ?string $maxId = null)
    {
        return $this->getClient()->feed($type, $query, $maxId);
    }

    /**
     * Retrieves story by type.
     *
     * @param  string  $query
     * @param  string|null  $maxId
     *
     * @return FeedMessage|Promise<FeedMessage>
     * @throws \Exception
     */
    public function story(string $query, ?string $maxId = null)
    {
        return $this->getClient()->story($query, $maxId);
    }

    /**
     * Retrieves the timeline feed for the current user.
     *
     * @param  TimelineOptions|null  $options
     *
     * @return Timeline|Promise<Timeline>
     */
    public function timeline(?TimelineOptions $options = null)
    {
        return $this->getClient()->timeline($options ?? new TimelineOptions());
    }

    /**
     * Returns the client.
     *
     * @return Client
     */
    abstract protected function getClient(): Client;
}
