<?php

namespace NicklasW\Instagram\Client\Features;

use Exception;
use GuzzleHttp\Promise\Promise;
use NicklasW\Instagram\DTO\Messages\InboxMessage;
use NicklasW\Instagram\DTO\Messages\ThreadMessage;
use NicklasW\Instagram\Requests\Direct\InboxRequest;
use NicklasW\Instagram\Requests\Direct\ThreadRequest;

trait DirectFeaturesTrait
{

    use DefaultFeaturesTrait;

    /**
     * Retrieves the inbox.
     *
     * @throws Exception
     * @return InboxMessage|Promise<InboxMessage>
     */
    public function inbox()
    {
        return $this->adapter->run(function () {
            $this->checkPrerequisites();

            return (new InboxRequest($this, $this->session, $this->client))->fire();
        });
    }

    /**
     * Retrieves a thread.
     *
     * @param string      $id     The thread id
     * @param string|null $cursor The cursor id
     * @throws Exception
     * @return ThreadMessage|Promise<ThreadMessage>
     */
    public function thread(string $id, ?string $cursor = null)
    {
        return $this->adapter->run(function () use ($id, $cursor) {
            $this->checkPrerequisites();

            return (new ThreadRequest($this, $this->session, $this->client, $id, $cursor))->fire();
        });
    }

}