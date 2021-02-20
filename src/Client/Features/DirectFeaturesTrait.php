<?php

declare(strict_types=1);

namespace Instagram\SDK\Client\Features;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\DTO\Messages\Direct\DirectSendItemMessage;
use Instagram\SDK\DTO\Messages\Direct\InboxMessage;
use Instagram\SDK\DTO\Messages\Direct\SeenMessage;
use Instagram\SDK\DTO\Messages\Direct\ThreadMessage;
use Instagram\SDK\Requests\Request;
use function GuzzleHttp\Promise\task;
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
     * Retrieves the inbox.
     *
     * @return PromiseInterface<InboxMessage>
     */
    public function inbox(): PromiseInterface
    {
        return task(function (): PromiseInterface {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            $request = $this->buildRequest('direct_v2/inbox/', new InboxMessage(), 'GET');

            return $this->call($request);
        });
    }

    /**
     * Retrieves a thread.
     *
     * @param string      $id     The thread id
     * @param string|null $cursor The cursor id
     * @return PromiseInterface<ThreadMessage>
     */
    public function thread(string $id, ?string $cursor = null): PromiseInterface
    {
        return task(function () use ($id, $cursor): PromiseInterface {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            $request = $this->buildRequest(sprintf('direct_v2/threads/%s/', $id), new ThreadMessage(), 'GET')
                ->addQueryParamIfNotNull('cursor', $cursor);

            return $this->call($request);
        });
    }

    /**
     * Sends a thread message.
     *
     * @param string $text
     * @param string $threadId
     * @return PromiseInterface<DirectSendItemMessage>
     */
    public function sendThreadMessage(string $text, string $threadId): PromiseInterface
    {
        return task(function () use ($text, $threadId): PromiseInterface {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            $request = $this->buildRequest('direct_v2/threads/broadcast/text', new DirectSendItemMessage())
                ->addPayloadParam('text', $text)
                ->addPayloadParam('thread_ids', "[$threadId]")
                ->addPayloadParam('action', 'send_item')
                ->addUniqueContext()
                ->addCSRFTokenAndUserId();

            return $this->call($request);
        });
    }

    /**
     * Set thread id as seen.
     *
     * @param string $threadId
     * @param string $threadItemId
     * @return PromiseInterface<SeenMessage>
     */
    public function seen(string $threadId, string $threadItemId): PromiseInterface
    {
        return task(function () use ($threadId, $threadItemId): PromiseInterface {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            // @phan-suppress-next-line PhanPluginPrintfVariableFormatString
            // phpcs:ignore
            $request = $this->buildRequest(sprintf('direct_v2/threads/%s/items/%s/seen/', $threadId, $threadItemId), new SeenMessage())
                ->addCSRFToken()
                ->addUuid();

            return $this->call($request);
        });
    }
}
