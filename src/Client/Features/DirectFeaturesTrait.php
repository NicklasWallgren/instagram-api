<?php

declare(strict_types=1);

namespace Instagram\SDK\Client\Features;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\DTO\Messages\Direct\DirectSendItemMessage;
use Instagram\SDK\DTO\Messages\Direct\InboxMessage;
use Instagram\SDK\DTO\Messages\Direct\SeenMessage;
use Instagram\SDK\DTO\Messages\Direct\ThreadMessage;
use Instagram\SDK\Requests\GenericRequest;
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
     * Retrieves the inbox.
     *
     * @return PromiseInterface<InboxMessage>
     */
    public function inbox(): PromiseInterface
    {
        return task(function (): PromiseInterface {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            /** @var GenericRequest $request */
            $request = request('direct_v2/inbox/', new InboxMessage(), 'GET')(
                $this,
                $this->session,
                $this->client
            );

            return $request->fire();
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

            // Request, GenericRequest

            $request = $this->request(sprintf('direct_v2/threads/%s/', $id), new ThreadMessage(), 'GET');

            $request->addQueryParamIfNotNull('cursor', $cursor);

            // $request->build()

//            $this->client->request(); request, serializer


            return $request->fire();
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

            /** @var GenericRequest $request */
            $request = request('direct_v2/threads/broadcast/text', new DirectSendItemMessage())(
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

            return $request->fire();
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

            /** @var GenericRequest $request */
            // @phan-suppress-next-line PhanPluginPrintfVariableFormatString
            // phpcs:ignore
            $request = request(sprintf('direct_v2/threads/%s/items/%s/seen/', $threadId, $threadItemId), new SeenMessage())(
                $this,
                $this->session,
                $this->client
            );

            // Prepare the request payload
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall, PhanUndeclaredMethod
            $request
                ->addCSRFToken()
                ->addUuid();

            return $request->fire();
        });
    }
}
