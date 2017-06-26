<?php

namespace NicklasW\Instagram\Requests\Traits;

use GuzzleHttp\Promise\Promise;
use NicklasW\Instagram\Client\Client;
use NicklasW\Instagram\DTO\Messages\Direct\DirectSendItemMessage;
use NicklasW\Instagram\DTO\Messages\Direct\InboxMessage;
use NicklasW\Instagram\DTO\Messages\Direct\ThreadMessage;

trait MakeDirectRequestAccessible
{

    /**
     * Returns the inbox.
     *
     * @return InboxMessage|Promise<InboxMessage>
     */
    public function inbox()
    {
        return $this->getClient()->inbox();
    }

    /**
     * Returns a thread by id and cursor.
     *
     * @param string      $id     The thread id
     * @param string|null $cursor The cursor
     * @return ThreadMessage|Promise<ThreadMessage>
     */
    public function thread(string $id, ?string $cursor = null)
    {
        return $this->getClient()->thread($id, $cursor);
    }

    /**
     * Sends a message to a thread.
     *
     * @param string $text
     * @param string $threadId
     * @return DirectSendItemMessage|Promise<DirectSendItemMessage>
     */
    public function sendThreadMessage(string $text, string $threadId)
    {
        return $this->getClient()->sendThreadMessage($text, $threadId);
    }

    /**
     * Returns the client.
     *
     * @return Client
     */
    abstract protected function getClient(): Client;
}
