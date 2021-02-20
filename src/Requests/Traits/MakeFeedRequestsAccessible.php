<?php

namespace Instagram\SDK\Requests\Traits;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Messages\Feed\FeedMessage;
use Instagram\SDK\DTO\Messages\Feed\TimelineMessage;
use Instagram\SDK\Requests\Feed\TimelineOptions;
use const Instagram\SDK\TYPE_HASHTAG;
use const Instagram\SDK\TYPE_USER;

/**
 * Trait MakeFeedRequestsAccessible
 *
 * @package Instagram\SDK\Requests\Traits
 */
trait MakeFeedRequestsAccessible
{

    /**
     * Retrieves feed by hashtag.
     *
     * @param string $tag
     * @return FeedMessage
     * @throws \Exception
     */
    public function feedByHashtag(string $tag): FeedMessage
    {
        return $this->feedByHashtagPromise($tag)->wait();
    }

    /**
     * Retrieves feed by hashtag.
     *
     * @param string $tag
     * @return PromiseInterface<FeedMessage>
     */
    public function feedByHashtagPromise(string $tag): PromiseInterface
    {
        return $this->feed(TYPE_HASHTAG, $tag);
    }

    /**
     * Retrieves feed by user.
     *
     * @param string $userId
     * @return FeedMessage
     * @throws \Exception
     */
    public function feedByUser(string $userId): FeedMessage
    {
        return $this->feedByUserPromise($userId)->wait();
    }

    /**
     * Retrieves feed by user.
     *
     * @param string $userId
     * @return PromiseInterface<FeedMessage>
     */
    public function feedByUserPromise(string $userId): PromiseInterface
    {
        return $this->feed(TYPE_USER, $userId);
    }

    /**
     * Retrieves the timeline feed for the current user.
     *
     * @param TimelineOptions|null $options
     * @return TimelineMessage
     */
    public function timeline(?TimelineOptions $options = null): TimelineMessage
    {
        return $this->timelinePromise($options)->wait();
    }

    /**
     * Retrieves the timeline feed for the current user.
     *
     * @param TimelineOptions|null $options
     * @return PromiseInterface<TimelineMessage>
     */
    public function timelinePromise(?TimelineOptions $options = null): PromiseInterface
    {
        return $this->getClient()->timeline($options ?? new TimelineOptions());
    }

    /**
     * Returns the client.
     *
     * @return Client
     */
    abstract protected function getClient(): Client;

    /**
     * Retrieves feed by type.
     *
     * @param int         $type
     * @param string      $query
     * @param string|null $maxId
     * @return PromiseInterface<FeedMessage>
     */
    private function feed(int $type, string $query, ?string $maxId = null): PromiseInterface
    {
        return $this->getClient()->feed($type, $query, $maxId);
    }
}
