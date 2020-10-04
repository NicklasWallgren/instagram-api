<?php

namespace Instagram\SDK\Client\Features;

use Exception;
use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\Messages\Feed\FeedMessage;
use Instagram\SDK\DTO\Messages\Feed\Timeline;
use Instagram\SDK\Instagram;
use Instagram\SDK\Requests\Feed\TimelineOptions;
use Instagram\SDK\Requests\GenericRequest;
use Instagram\SDK\Support\Promise;
use function Instagram\SDK\Support\Promises\rejection_for;
use function Instagram\SDK\Support\Promises\task;
use function Instagram\SDK\Support\request;
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
     * @var string The hastag feed uri
     */
    private static $URI_HASHTAG_FEED = 'feed/tag/%s/';

    /**
     * @var string The user feed uri
     */
    private static $URI_USER_FEED = 'feed/user/%s/';

    /**
     * @var string The timeline uri
     */
    private static $URI_TIMELINE_FEED = 'feed/timeline/';

    /**
     * Retrieves feed by hashtag.
     *
     * @param string $tag
     * @return FeedMessage|Promise<FeedMessage>
     * @throws Exception
     */
    public function feedByHashtag(string $tag)
    {
        return $this->feed(TYPE_HASHTAG, $tag);
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
        return $this->feed(TYPE_USER, $user);
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
            case TYPE_HASHTAG:
                $result = $this->queryFeed($type, self::$URI_HASHTAG_FEED, $query, FeedMessage::class, $maxId);

                break;
            case TYPE_USER:
                $result = $this->queryFeed($type, self::$URI_USER_FEED, $query, FeedMessage::class, $maxId);

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
     * @return Promise|Promise<Timeline>
     */
    public function timeline(TimelineOptions $options)
    {
        return task(function () use ($options): Promise {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            /**
             * @var GenericRequest $request
             */
            $request = request(self::$URI_TIMELINE_FEED, new Timeline())(
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
                ->setPost('reason', 'cold_start_fetch')
                ->addPayloadOptions($options);

            // Invoke the request
            return $request->fire();
        })($this->getMode());
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

            // @phan-suppress-next-line PhanPluginPrintfVariableFormatString
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
     * Creates a generic request.
     *
     * @param string   $uri
     * @param Envelope $message
     * @return GenericRequest
     */
    protected function request(string $uri, Envelope $message): GenericRequest
    {
        return request($uri, $message)(
            $this,
            $this->session,
            $this->client
        );
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
