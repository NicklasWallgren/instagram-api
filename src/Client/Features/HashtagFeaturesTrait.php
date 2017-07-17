<?php

namespace Instagram\SDK\Client\Features;

use Instagram\SDK\DTO\Messages\Hashtag\FeedMessage;
use function Instagram\SDK\Promises\task;
use function Instagram\SDK\Support\request;

trait HashtagFeaturesTrait
{

    use DefaultFeaturesTrait;

    /**
     * @var string The tag search endpoint
     */
    private static $ENDPOINT_TAG_SEARCH = 'tags/search/';

    /**
     * @var string The tag search endpoint
     */
    private static $ENDPOINT_TAG_FEED = 'feed/tag/%s/';

    /**
     * Search for hashtag.
     *
     * @param string $tag
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function search(string $tag)
    {
        return task(function () use ($tag) {
            throw new Exception('To be implemented.');
        });
    }

    /**
     * Retrieves the feed for a specified hashtag.
     *
     * @param string      $tag
     * @param string|null $maxId
     * @return SessionMessage|Promise<InboxMessage>
     */
    public function feed(string $tag, ?string $maxId = null)
    {
        // Prepare the tag query
        $tag = urlencode($tag);

        return task(function () use ($tag, $maxId) {
            $message = new FeedMessage();
            $message->setQuery($tag);

            // Build the request instance
            $request = request(sprintf(self::$ENDPOINT_TAG_FEED, $tag), $message)($this, $this->session,
                $this->client);

            // Prepare the request parameters
            $request->addParam('max_id', $maxId);

            // Invoke the request
            return $request->fire();
        })($this->getMode());
    }

    /**
     * Retrieves related hashtags.
     *
     * @param string $tag
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function related(string $tag)
    {
        return task(function () use ($tag) {
            throw new Exception('To be implemented.');
        });
    }
}
