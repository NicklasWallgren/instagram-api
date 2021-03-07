<?php

declare(strict_types=1);

namespace Instagram\SDK\Client\Features;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Exceptions\InstagramException;
use Instagram\SDK\Response\Responses\Direct\DirectSendItemResponse;
use Instagram\SDK\Response\Responses\Direct\InboxResponse;
use Instagram\SDK\Response\Responses\Direct\SeenResponse;
use Instagram\SDK\Response\Responses\Direct\ThreadResponse;

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
     * Retrieve the {@link InboxResponse}.
     *
     * @return PromiseInterface<InboxResponse|InstagramException>
     */
    public function inbox(): PromiseInterface
    {
        return $this->authenticated(function (): PromiseInterface {
            $request = $this->buildRequest('direct_v2/inbox/', new InboxResponse(), 'GET');

            return $this->call($request);
        });
    }

    /**
     * Retrieves a thread.
     *
     * @param string      $id     The thread id
     * @param string|null $cursor The cursor id
     * @return PromiseInterface<ThreadResponse>
     */
    public function thread(string $id, ?string $cursor = null): PromiseInterface
    {
        return $this->authenticated(function () use ($id, $cursor): PromiseInterface {
            $request = $this->buildRequest(sprintf('direct_v2/threads/%s/', $id), new ThreadResponse(), 'GET')
                ->addQueryParamIfNotNull('cursor', $cursor);

            return $this->call($request);
        });
    }

    /**
     * Sends a thread message.
     *
     * @param string $text
     * @param string $threadId
     * @return PromiseInterface<DirectSendItemResponse>
     */
    public function sendThreadMessage(string $text, string $threadId): PromiseInterface
    {
        return $this->authenticated(function () use ($text, $threadId): PromiseInterface {
            $request = $this->buildRequest('direct_v2/threads/broadcast/text', new DirectSendItemResponse())
                ->addPayloadParam('text', $text)
                ->addPayloadParam('thread_ids', "[$threadId]")
                ->addPayloadParam('action', 'send_item')
                ->addUniqueContext()
                ->addCSRFTokenAndUserId($this->session);

            return $this->call($request);
        });
    }

    /**
     * Set thread id as seen.
     *
     * @param string $threadId
     * @param string $threadItemId
     * @return PromiseInterface<SeenResponse>
     */
    public function seen(string $threadId, string $threadItemId): PromiseInterface
    {
        return $this->authenticated(function () use ($threadId, $threadItemId): PromiseInterface {
            // @phan-suppress-next-line PhanPluginPrintfVariableFormatString
            // phpcs:ignore
            $request = $this->buildRequest(sprintf('direct_v2/threads/%s/items/%s/seen/', $threadId, $threadItemId), new SeenResponse())
                ->addCSRFToken($this->session)
                ->addUuid($this->session);

            return $this->call($request);
        });
    }
}
