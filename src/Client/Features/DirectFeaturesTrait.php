<?php

namespace Instagram\SDK\Client\Features;

use Exception;
use Instagram\SDK\DTO\Messages\Direct\DirectSendItemMessage;
use Instagram\SDK\DTO\Messages\Direct\InboxMessage;
use Instagram\SDK\DTO\Messages\Direct\SeenMessage;
use Instagram\SDK\DTO\Messages\Direct\ThreadMessage;
use Instagram\SDK\Requests\Direct\InboxRequest;
use Instagram\SDK\Requests\Direct\ThreadRequest;
use Instagram\SDK\Requests\GenericRequest;
use Instagram\SDK\Support\Promise;
use function Instagram\SDK\Support\Promises\task;
use function Instagram\SDK\Support\request;

/**
 * Trait DirectFeaturesTrait
 *
 * @package            Instagram\SDK\Client\Features
 * @phan-file-suppress PhanUnreferencedUseNormal
 */
trait DirectFeaturesTrait
{

    use DefaultFeaturesTrait;

    /**
     * @var string The message broadcast uri
     */
    private static $URI_BROADCAST_MESSAGE = 'direct_v2/threads/broadcast/text/';

    /**
     * @var string The thread seen uri
     */
    private static $URI_SEEN = 'direct_v2/threads/%s/items/%s/seen/';

    /**
     * Retrieves the inbox.
     *
     * @return InboxMessage|Promise<InboxMessage>
     * @throws Exception
     */
    public function inbox()
    {
        return task(function (): Promise {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            return (new InboxRequest($this->getSubject(), $this->session, $this->client))->fire();
        })($this->getMode());
    }

    /**
     * Retrieves a thread.
     *
     * @param string      $id     The thread id
     * @param string|null $cursor The cursor id
     * @return ThreadMessage|Promise<ThreadMessage>
     */
    public function thread(string $id, ?string $cursor = null)
    {
        return task(function () use ($id, $cursor): Promise {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            return (new ThreadRequest($this->getSubject(), $this->session, $this->client, $id, $cursor))->fire();
        })($this->getMode());
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
        return task(function () use ($text, $threadId): Promise {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            /** @var GenericRequest $request */
            $request = request(self::$URI_BROADCAST_MESSAGE, new DirectSendItemMessage())(
                $this,
                $this->session,
                $this->client
            );

            // Prepare the request payload
            $request->addPayloadParam('text', $text)
                ->addPayloadParam('thread_ids', "[$threadId]")
                ->addPayloadParam('action', 'send_item')
                ->addUniqueContext()
                ->addCSRFTokenAndUserId();

            // Invoke the request
            return $request->fire();
        })($this->getMode());
    }

    /**
     * Set thread id as seen.
     *
     * @param string $threadId
     * @param string $threadItemId
     * @return SeenMessage|Promise<SeenMessage>
     */
    public function seen(string $threadId, string $threadItemId)
    {
        return task(function () use ($threadId, $threadItemId): Promise {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            /**
             * @var GenericRequest $request
             */
            // @phan-suppress-next-line PhanPluginPrintfVariableFormatString
            $request = request(sprintf(self::$URI_SEEN, $threadId, $threadItemId), new SeenMessage())(
                $this,
                $this->session,
                $this->client
            );

            // Prepare the request payload
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall, PhanUndeclaredMethod
            $request
                ->addCSRFToken()
                ->addUuid();

            // Invoke the request
            return $request->fire();
        })($this->getMode());
    }
}
