<?php

namespace Instagram\SDK\Requests\Traits;

use Exception;
use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Messages\Direct\DirectSendItemMessage;
use Instagram\SDK\DTO\Messages\Direct\InboxMessage;
use Instagram\SDK\DTO\Messages\Direct\SeenMessage;
use Instagram\SDK\DTO\Messages\Direct\ThreadMessage;

/**
 * Trait MakeDirectRequestAccessible
 *
 * @package Instagram\SDK\Requests\Traits
 */
trait MakeDirectRequestAccessible
{

    /**
     * Returns the inbox.
     *
     * @return InboxMessage
     * @throws Exception
     */
    public function inbox(): InboxMessage
    {
        return $this->inboxPromise()->wait();
    }

    /**
     * Returns the inbox.
     *
     * @return PromiseInterface<InboxMessage>
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
     * @return ThreadMessage
     */
    public function thread(string $id, ?string $cursor = null): ThreadMessage
    {
        return $this->threadPromise($id, $cursor)->wait();
    }

    /**
     * Returns a thread by id and cursor.
     *
     * @param string      $id     The thread id
     * @param string|null $cursor The cursor
     * @return PromiseInterface<ThreadMessage>
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
     * @return DirectSendItemMessage
     */
    public function sendThreadMessage(string $text, string $threadId): DirectSendItemMessage
    {
        return $this->sendThreadMessagePromise($text, $threadId)->wait();
    }

    /**
     * Sends a message to a thread.
     *
     * @param string $text
     * @param string $threadId
     * @return PromiseInterface<DirectSendItemMessage>
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
     * @return SeenMessage
     */
    public function seen(string $threadId, string $threadItemId): SeenMessage
    {
        return $this->seenPromise($threadId, $threadItemId)->wait();
    }

    /**
     * Sets thread item as seen.
     *
     * @param string $threadId
     * @param string $threadItemId
     * @return PromiseInterface<SeenMessage>
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
