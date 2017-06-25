<?php

namespace NicklasW\Instagram\Client\Features;

use Exception;
use GuzzleHttp\Promise\Promise;
use NicklasW\Instagram\DTO\Messages\Direct\DirectSendItemMessage;
use NicklasW\Instagram\DTO\Messages\Direct\InboxMessage;
use NicklasW\Instagram\DTO\Messages\Direct\ThreadMessage;
use NicklasW\Instagram\Requests\Direct\InboxRequest;
use NicklasW\Instagram\Requests\Direct\ThreadRequest;
use function NicklasW\Instagram\Support\request;

trait DirectFeaturesTrait
{

    use DefaultFeaturesTrait;

    /**
     * @var string The message broadcast uri
     */
    private static $URI_BROADCAST_MESSAGE = 'direct_v2/threads/broadcast/text/';

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

    /**
     * Sends a thread message.
     *
     * @param string $text
     * @param string $threadId
     * @return DirectSendItemMessage|Promise<DirectSendItemMessage>
     */
    public function sendThreadMessage(string $text, string $threadId)
    {
        return $this->adapter->run(function () use ($text, $threadId) {
            $this->checkPrerequisites();

            // Build the request instance
            $request = request(self::$URI_BROADCAST_MESSAGE, new DirectSendItemMessage())($this, $this->session,
                $this->client);

            // Prepare the request payload
            $request->setPost('text', $text)
                    ->setPost('thread_ids', "[$threadId]")
                    ->setPost('action', 'send_item')
                    ->addUniqueContext()
                    ->addCSRFTokenAndUserId();

            // Invoke the request
            return $request->fire();
        });
    }

}