<?php

declare(strict_types=1);

namespace Instagram\SDK\Traits;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Client\Client;
use Instagram\SDK\Exceptions\InstagramException;
use Instagram\SDK\Request\Payload\Feed\TimelineRequestPayload;
use Instagram\SDK\Response\Responses\Feed\FeedResponse;
use Instagram\SDK\Response\Responses\Feed\TimelineResponse;
use Instagram\SDK\Utils\PromiseUtils;
use const Instagram\SDK\TYPE_HASHTAG;
use const Instagram\SDK\TYPE_USER;

/**
 * Trait MakeFeedRequestsAccessible
 *
 * @package Instagram\SDK\Traits
 */
trait MakeFeedRequestsAccessible
{

    /**
     * Retrieves feed by hashtag.
     *
     * @param string $tag
     * @return FeedResponse
     * @throws InstagramException in case of an error
     */
    public function feedByHashtag(string $tag): FeedResponse
    {
        return PromiseUtils::wait($this->feedByHashtagPromise($tag));
    }

    /**
     * Retrieves feed by hashtag.
     *
     * @param string $tag
     * @return PromiseInterface<FeedResponse|InstagramException>
     */
    public function feedByHashtagPromise(string $tag): PromiseInterface
    {
        return $this->feed(TYPE_HASHTAG, $tag);
    }

    /**
     * Retrieves feed by user.
     *
     * @param string $userId
     * @return FeedResponse
     * @throws InstagramException in case of an error
     */
    public function feedByUser(string $userId): FeedResponse
    {
        return PromiseUtils::wait($this->feedByUserPromise($userId));
    }

    /**
     * Retrieves feed by user.
     *
     * @param string $userId
     * @return PromiseInterface<FeedResponse|InstagramException>
     */
    public function feedByUserPromise(string $userId): PromiseInterface
    {
        return $this->feed(TYPE_USER, $userId);
    }

    /**
     * Retrieves the timeline feed for the current user.
     *
     * @param TimelineRequestPayload|null $options
     * @return TimelineResponse
     */
    public function timeline(?TimelineRequestPayload $options = null): TimelineResponse
    {
        return PromiseUtils::wait($this->timelinePromise($options));
    }

    /**
     * Retrieves the timeline feed for the current user.
     *
     * @param TimelineRequestPayload|null $options
     * @return PromiseInterface<TimelineResponse|InstagramException>
     */
    public function timelinePromise(?TimelineRequestPayload $options = null): PromiseInterface
    {
        return $this->getClient()->timeline($options ?? new TimelineRequestPayload());
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
     * @return PromiseInterface<FeedResponse|InstagramException>
     */
    private function feed(int $type, string $query, ?string $maxId = null): PromiseInterface
    {
        return $this->getClient()->feed($type, $query, $maxId);
    }
}
