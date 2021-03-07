<?php

declare(strict_types=1);

namespace Instagram\SDK\Client\Features;

use GuzzleHttp\Promise\Create;
use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Exceptions\InstagramException;
use Instagram\SDK\Request\Payload\Feed\TimelineRequestPayload;
use Instagram\SDK\Response\Responses\Feed\FeedResponse;
use Instagram\SDK\Response\Responses\Feed\TimelineResponse;
use const Instagram\SDK\TYPE_HASHTAG;
use const Instagram\SDK\TYPE_USER;

/**
 * Trait FeedFeaturesTrait
 *
 * @package Instagram\SDK\Client\Features
 */
trait FeedFeaturesTrait
{

    use DefaultFeaturesTrait;

    /**
     * Retrieve feed by hashtag.
     *
     * @param string $hashTag
     * @return PromiseInterface<FeedResponse|InstagramException>
     */
    public function feedByHashtag(string $hashTag): PromiseInterface
    {
        return $this->feed(TYPE_HASHTAG, $hashTag);
    }

    /**
     * Retrieve feed by user.
     *
     * @param string $userName
     * @return PromiseInterface<FeedResponse|InstagramException>
     */
    public function feedByUser(string $userName): PromiseInterface
    {
        return $this->feed(TYPE_USER, $userName);
    }

    /**
     * Retrieve the feed for a specified hashtag.
     *
     * @param int         $type
     * @param string      $query
     * @param string|null $maxId
     * @return PromiseInterface<FeedResponse|InstagramException>
     */
    public function feed(int $type, string $query, ?string $maxId = null): PromiseInterface
    {
        switch ($type) {
            case TYPE_HASHTAG:
                $result = $this->queryFeed($type, 'feed/tag/%s/', $query, $maxId);
                break;
            case TYPE_USER:
                $result = $this->queryFeed($type, 'feed/user/%s/', $query, $maxId);
                break;
            default:
                $result = $this->getInvalidFeedTypeError();
                break;
        }

        return $result;
    }

    /**
     * Retrieve the timeline feed for the current user.
     *
     * @param TimelineRequestPayload $payload
     * @return PromiseInterface<TimelineResponse|InstagramException>
     */
    public function timeline(TimelineRequestPayload $payload): PromiseInterface
    {
        return $this->authenticated(function () use ($payload): PromiseInterface {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall, PhanUndeclaredMethod
            $request = $this->buildRequest('feed/timeline/', new TimelineResponse())
                ->addCSRFToken($this->session)
                ->addUuid($this->session)
                ->addPhoneId($this->session)
                ->addSessionId($this->session)
                ->addPayloadParam('reason', 'cold_start_fetch')
                ->addPayloadParams($payload);

            return $this->call($request);
        });
    }

    /**
     * Query for the feed result.
     *
     * @param int         $type
     * @param string      $uri
     * @param string      $query
     * @param string|null $maxId
     * @return PromiseInterface<FeedResponse|InstagramException>
     */
    protected function queryFeed(int $type, string $uri, string $query, ?string $maxId): PromiseInterface
    {
        return $this->authenticated(function () use ($type, $uri, $query, $maxId): PromiseInterface {
            $response = new FeedResponse($tag = rawurlencode($query), $type);

            // @phan-suppress-next-line PhanPluginPrintfVariableFormatString
            $request = $this->buildRequest(sprintf($uri, $tag), $response)
                ->addQueryParamIfNotNull('max_id', $maxId);

            return $this->call($request);
        });
    }

    /**
     * Returns the invalid type error.
     *
     * @return PromiseInterface
     */
    protected function getInvalidFeedTypeError(): PromiseInterface
    {
        // @phan-suppress-next-line PhanDeprecatedFunction
        return Create::rejectionFor('Invalid feed type provided');
    }
}
