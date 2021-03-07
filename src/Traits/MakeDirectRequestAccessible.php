<?php

declare(strict_types=1);

namespace Instagram\SDK\Traits;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Client\Client;
use Instagram\SDK\Exceptions\InstagramException;
use Instagram\SDK\Response\Responses\Direct\DirectSendItemResponse;
use Instagram\SDK\Response\Responses\Direct\InboxResponse;
use Instagram\SDK\Response\Responses\Direct\SeenResponse;
use Instagram\SDK\Response\Responses\Direct\ThreadResponse;
use Instagram\SDK\Utils\PromiseUtils;

/**
 * Trait MakeDirectRequestAccessible
 *
 * @package Instagram\SDK\Traits
 */
trait MakeDirectRequestAccessible
{

    /**
     * Returns the {@link InboxResponse}.
     *
     * @return InboxResponse
     * @throws InstagramException in case of an error
     */
    public function inbox(): InboxResponse
    {
        return PromiseUtils::wait($this->inboxPromise());
    }

    /**
     * Returns the inbox as a {@link PromiseInterface}.
     *
     * @return PromiseInterface<InboxResponse|InstagramException>
     */
    public function inboxPromise(): PromiseInterface
    {
        return $this->getClient()->inbox();
    }

    /**
     * Returns a thread by id and cursor.
     *
     * @param string      $id     The thread id
     * @param string|null $cursor The cursor
     * @return ThreadResponse
     * @throws InstagramException in case of an error
     */
    public function thread(string $id, ?string $cursor = null): ThreadResponse
    {
        return PromiseUtils::wait($this->threadPromise($id, $cursor));
    }

    /**
     * Returns a thread by id and cursor.
     *
     * @param string      $id     The thread id
     * @param string|null $cursor The cursor
     * @return PromiseInterface<ThreadResponse|InstagramException>
     * @throws InstagramException in case of an error
     */
    public function threadPromise(string $id, ?string $cursor = null): PromiseInterface
    {
        return $this->getClient()->thread($id, $cursor);
    }

    /**
     * Sends a message to a thread.
     *
     * @param string $text
     * @param string $threadId
     * @return DirectSendItemResponse
     * @throws InstagramException in case of an error
     */
    public function sendThreadMessage(string $text, string $threadId): DirectSendItemResponse
    {
        return PromiseUtils::wait($this->sendThreadMessagePromise($text, $threadId));
    }

    /**
     * Sends a message to a thread.
     *
     * @param string $text
     * @param string $threadId
     * @return PromiseInterface<DirectSendItemResponse|InstagramException>
     */
    public function sendThreadMessagePromise(string $text, string $threadId): PromiseInterface
    {
        return $this->getClient()->sendThreadMessage($text, $threadId);
    }

    /**
     * Sets thread item as seen.
     *
     * @param string $threadId
     * @param string $threadItemId
     * @return SeenResponse
     * @throws InstagramException in case of an error
     */
    public function seen(string $threadId, string $threadItemId): SeenResponse
    {
        return PromiseUtils::wait($this->seenPromise($threadId, $threadItemId));
    }

    /**
     * Sets thread item as seen.
     *
     * @param string $threadId
     * @param string $threadItemId
     * @return PromiseInterface<SeenResponse|InstagramException>
     */
    public function seenPromise(string $threadId, string $threadItemId): PromiseInterface
    {
        return $this->getClient()->seen($threadId, $threadItemId);
    }

    /**
     * Returns the client.
     *
     * @return Client
     */
    abstract protected function getClient(): Client;
}
