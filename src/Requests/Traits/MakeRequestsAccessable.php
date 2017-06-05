<?php

namespace NicklasW\Instagram\Requests\Traits;

use GuzzleHttp\Promise\Promise;
use NicklasW\Instagram\Client\Client;
use NicklasW\Instagram\DTO\Messages\Discover\ExploreMessage;
use NicklasW\Instagram\DTO\Messages\InboxMessage;
use NicklasW\Instagram\DTO\Messages\SessionMessage;
use NicklasW\Instagram\DTO\Messages\ThreadMessage;

trait MakeRequestsAccessable
{

    /**
     * Login a user
     *
     * @param string $username
     * @param string $password
     * @return SessionMessage|Promise<SessionMessage>
     */
    public function login(string $username, string $password)
    {
        return $this->getClient()->login($username, $password);
    }

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
     * Returns the explore items.
     *
     * @return ExploreMessage|Promise<ExploreMessage>
     */
    public function explore()
    {
        return $this->getClient()->explore();
    }

    /**
     * Returns the client.
     *
     * @return Client
     */
    abstract protected function getClient(): Client;

}