<?php

namespace Instagram\SDK\Client\Features;

use Instagram\SDK\DTO\Messages\Hashtag\FeedMessage;
use Instagram\SDK\DTO\Messages\Hashtag\SearchResultMessage;
use function Instagram\SDK\Support\Promises\task;
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
     * @param string $query
     * @return SearchResultMessage|Promise<SearchResultMessage>
     */
    public function search(string $query)
    {
        // Prepare the tag query
        $query = rawurlencode($query);

        return task(function () use ($query) {
            $message = new SearchResultMessage();
            $message->setQuery($query);

            // Build the request instance
            $request = request(self::$ENDPOINT_TAG_SEARCH, $message)($this, $this->session,
                $this->client);

            // Prepare the request parameters
            $request
                ->addRankedToken()
                ->setParam('q', $query)
                ->setParam('is_typeahead', true);

            // Invoke the request
            return $request->fire();
        })($this->getMode());
    }

    /**
     * Retrieves the feed for a specified hashtag.
     *
     * @param string      $tag
     * @param string|null $maxId
     * @return FeedMessage|Promise<FeedMessage>
     */
    public function feed(string $tag, ?string $maxId = null)
    {
        // Prepare the tag query
        $tag = rawurlencode($tag);

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
