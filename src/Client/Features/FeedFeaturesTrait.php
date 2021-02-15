<?php

declare(strict_types=1);

namespace Instagram\SDK\Client\Features;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\DTO\Messages\Feed\FeedMessage;
use Instagram\SDK\DTO\Messages\Feed\TimelineMessage;
use Instagram\SDK\Requests\Feed\TimelineOptions;
use Instagram\SDK\Requests\GenericRequest;
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
     * Retrieves feed by hashtag.
     *
     * @param string $tag
     * @return PromiseInterface<FeedMessage>
     */
    public function feedByHashtag(string $tag): PromiseInterface
    {
        return $this->feed(TYPE_HASHTAG, $tag);
    }

    /**
     * Retrieves feed by user.
     *
     * @param string $user
     * @return PromiseInterface<FeedMessage>
     */
    public function feedByUser(string $user): PromiseInterface
    {
        return $this->feed(TYPE_USER, $user);
    }

    /**
     * Retrieves the feed for a specified hashtag.
     *
     * @param int         $type
     * @param string      $query
     * @param string|null $maxId
     * @return PromiseInterface<FeedMessage>
     */
    public function feed(int $type, string $query, ?string $maxId = null): PromiseInterface
    {
        switch ($type) {
            case TYPE_HASHTAG:
                $result = $this->queryFeed($type, 'feed/tag/%s/', $query, FeedMessage::class, $maxId);
                break;
            case TYPE_USER:
                $result = $this->queryFeed($type, 'feed/user/%s/', $query, FeedMessage::class, $maxId);
                break;
            default:
                $result = $this->getInvalidFeedTypeError();
                break;
        }

        return $result;
    }

    /**
     * Retrieves the timeline feed for the current user.
     *
     * @param TimelineOptions $options
     * @return PromiseInterface<TimelineMessage>
     */
    public function timeline(TimelineOptions $options): PromiseInterface
    {
        return task(function () use ($options): PromiseInterface {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            /** @var GenericRequest $request */
            $request = request('feed/timeline/', new TimelineMessage())(
                $this,
                $this->session,
                $this->client
            );

            // Prepare the request payload
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall, PhanUndeclaredMethod
            $request
                ->addCSRFToken()
                ->addUuid()
                ->addPhoneId()
                ->addSessionId()
                ->addPayloadParam('reason', 'cold_start_fetch')
                ->addPayloadOptions($options);

            return $request->fire();
        });
    }

    /**
     * Queries for the feed result.
     *
     * @param int         $type
     * @param string      $uri
     * @param string      $query
     * @param string      $result
     * @param string|null $maxId
     * @return PromiseInterface<FeedMessage>
     */
    // phpcs:ignore
    protected function queryFeed(int $type, string $uri, string $query, string $result, ?string $maxId): PromiseInterface
    {
        // Prepare the tag query
        $tag = rawurlencode($query);

        return task(function () use ($type, $uri, $tag, $maxId, $result): PromiseInterface {
            $message = new $result();
            $message->setQuery($tag);
            $message->setType($type);

            /** @var GenericRequest $request */
            // @phan-suppress-next-line PhanPluginPrintfVariableFormatString
            $request = request(sprintf($uri, $tag), $message)(
                $this,
                $this->session,
                $this->client
            );

            // Prepare the request parameters
            $request->addQueryParamIfNotNull('max_id', $maxId);

            return $request->fire();
        });
    }

    /**
     * Returns the invalid type error.
     *
     * @return PromiseInterface
     */
    protected function getInvalidFeedTypeError(): PromiseInterface
    {
        return rejection_for('Invalid type provided');
    }
}
