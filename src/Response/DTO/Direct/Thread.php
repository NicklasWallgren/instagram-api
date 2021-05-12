<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\DTO\Direct;

use GuzzleHttp\Promise\Create;
use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Exceptions\InstagramException;
use Instagram\SDK\Response\DTO\Adapters\OnDecodeContext;
use Instagram\SDK\Response\DTO\Direct\Collections\LastSeenAtCollection;
use Instagram\SDK\Response\DTO\General\User;
use Instagram\SDK\Response\DTO\Interactive;
use Instagram\SDK\Response\Interfaces\IteratorInterface;
use Instagram\SDK\Response\Responses\Direct\DirectSendItemResponse;
use Instagram\SDK\Response\Responses\Direct\SeenResponse;
use Instagram\SDK\Response\Responses\Direct\ThreadResponse;
use Instagram\SDK\Response\Serializers\Interfaces\OnResponseDecodeInterface;
use Instagram\SDK\Utils\PromiseUtils;
use Tebru\Gson\Annotation\JsonAdapter;

/**
 * Class Thread
 *
 * @package            Instagram\SDK\Response\DTO\Direct
 * @phan-file-suppress PhanUnextractableAnnotation, PhanPluginUnknownPropertyType, PhanUnreferencedUseNormal
 */
final class Thread extends Interactive implements OnResponseDecodeInterface, IteratorInterface
{

    /** @var string */
    private $threadId;

    /**
     * @var User[]
     * @JsonAdapter("Instagram\SDK\Response\DTO\Adapters\OnDecodePropagatorAdapterFactory")
     */
    private $users = [];

    /**
     * @var User[]
     * @JsonAdapter("Instagram\SDK\Response\DTO\Adapters\OnDecodePropagatorAdapterFactory")
     */
    private $leftUsers = [];

    /**
     * @var ThreadItem[]
     */
    private $items;

    /** @var string */
    private $threadTitle;

    /** @var float */
    private $lastActivityAt;

    /** @var bool */
    private $muted;

    /** @var bool */
    private $named;

    /** @var bool */
    private $canonical;

    /** @var bool */
    private $pending;

    /** @var string */
    private $threadType;

    /** @var int */
    private $viewerId;

    /** @var bool */
    private $hasOlder;

    /** @var bool */
    private $hasNewer;

    /**
     * @var LastSeenAtCollection<LastSeenAt>
     * @JsonAdapter("Instagram\SDK\Response\DTO\Direct\Adapters\LastSeenAtArrayJsonAdapter")
     */
    private $lastSeenAt;

    /** @var string */
    private $newestCursor;

    /** @var string */
    private $oldestCursor;

    /**
     * Returns the thread items.
     *
     * @return ThreadItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return string
     */
    public function getThreadId(): string
    {
        return $this->threadId;
    }

    /**
     * @return User[]
     */
    public function getUsers(): array
    {
        return $this->users;
    }

    /**
     * @return User[]
     */
    public function getLeftUsers(): array
    {
        return $this->leftUsers;
    }

    public function getThreadTitle(): string
    {
        return $this->threadTitle;
    }

    public function getLastActivityAt(): float
    {
        return $this->lastActivityAt;
    }

    public function isMuted(): bool
    {
        return $this->muted;
    }

    public function isNamed(): bool
    {
        return $this->named;
    }

    public function isCanonical(): bool
    {
        return $this->canonical;
    }

    public function isPending(): bool
    {
        return $this->pending;
    }

    public function getThreadType(): string
    {
        return $this->threadType;
    }

    public function getViewerId(): int
    {
        return $this->viewerId;
    }

    public function getHasOlder(): bool
    {
        return $this->hasOlder;
    }

    public function getHasNewer(): bool
    {
        return $this->hasNewer;
    }

    /**
     * @return LastSeenAtCollection<LastSeenAt>
     */
    public function getLastSeenAt(): LastSeenAtCollection
    {
        return $this->lastSeenAt;
    }

    public function getNewestCursor(): string
    {
        return $this->newestCursor;
    }

    public function getOldestCursor(): string
    {
        return $this->oldestCursor;
    }

    /**
     * Retrieves the whole thread with thread items.
     *
     * @return ThreadResponse
     * @throws InstagramException
     */
    public function whole(): ThreadResponse
    {
        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return PromiseUtils::wait($this->retrieveByCursor());
    }

    /**
     * Retrieves the whole thread with thread items.
     *
     * @return PromiseInterface<ThreadResponse|InstagramException>
     */
    public function wholePromise(): PromiseInterface
    {
        return $this->retrieveByCursor();
    }

    /**
     * Step forward and get the next items in thread.
     *
     * @return ThreadResponse|null
     * @throws InstagramException
     */
    public function next(): ?ThreadResponse
    {
        // Check whether there are any older posts
        if (!$this->getHasOlder()) {
            return null;
        }

        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return PromiseUtils::wait($this->retrieveByCursor($this->oldestCursor));
    }

    /**
     * Step forward and get the next items in thread.
     *
     * @return PromiseInterface<?ThreadResponse|InstagramException>
     * @phan-suppress PhanParamSignatureMismatch
     */
    public function nextPromise(): PromiseInterface
    {
        // Check whether there are any older posts
        if (!$this->getHasOlder()) {
            return Create::promiseFor(null);
        }

        return $this->retrieveByCursor($this->oldestCursor);
    }

    /**
     * Step backward and get the previous items in thread.
     *
     * @return ThreadResponse|null
     * @throws InstagramException
     */
    public function rewind(): ?ThreadResponse
    {
        // Check whether there are any newer posts
        if (!$this->getHasNewer()) {
            return null;
        }

        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return PromiseUtils::wait($this->retrieveByCursor($this->newestCursor));
    }

    /**
     * Step backward and get the previous items in thread.
     *
     * @return PromiseInterface<?ThreadResponse|InstagramException>
     * @phan-suppress PhanParamSignatureMismatch
     */
    public function rewindPromise(): PromiseInterface
    {
        // Check whether there are any newer posts
        if (!$this->getHasNewer()) {
            return Create::promiseFor(null);
        }

        return $this->retrieveByCursor($this->newestCursor);
    }

    /**
     * Sends a message to the thread.
     *
     * @param string $text
     * @return DirectSendItemResponse
     * @throws InstagramException
     */
    public function sendMessage(string $text): DirectSendItemResponse
    {
        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return PromiseUtils::wait($this->sendMessagePromise($text));
    }

    /**
     * Sends a message to the thread.
     *
     * @param string $text
     * @phan-suppress PhanPluginMixedKeyNoKey
     * @return PromiseInterface<DirectSendItemResponse|InstagramException>
     */
    public function sendMessagePromise(string $text): PromiseInterface
    {
        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return $this->client->sendThreadMessage($text, $this->threadId);
    }

    /**
     * Sets the thread, or thread id as seen.
     *
     * @param string|null $threadItemId
     * @return SeenResponse
     * @throws InstagramException
     */
    public function seen(?string $threadItemId = null): SeenResponse
    {
        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return PromiseUtils::wait($this->seenPromise($threadItemId));
    }

    /**
     * Sets the thread, or thread id as seen.
     *
     * @param string|null $threadItemId
     * @return PromiseInterface<SeenResponse|InstagramException>
     */
    public function seenPromise(?string $threadItemId = null): PromiseInterface
    {
        $latestItem = current($this->items);

        return $this->client->seen($this->threadId, $threadItemId ?? $latestItem->getItemId());
    }

    /**
     * Refresh the thread with the latest updates.
     *
     * @suppress PhanPluginUnknownClosureReturnType
     * @return ThreadResponse|null
     * @throws InstagramException
     */
    public function refresh(): ?ThreadResponse
    {
        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return PromiseUtils::wait($this->refreshPromise());
    }

    /**
     * Refresh the thread with the latest updates.
     *
     * @suppress PhanPluginUnknownClosureReturnType
     * @return PromiseInterface<ThreadResponse|InstagramException>
     */
    public function refreshPromise(): PromiseInterface
    {
        return $this->retrieveByCursor();
    }

    /**
     * Returns unseen items for the user.
     *
     * @param int|null $userId
     * @return ThreadItem[]
     */
    public function getUnseenItems(?int $userId = null): array
    {
        $userId = $userId ?? $this->viewerId;

        if (($lastSeenAtForUser = $this->lastSeenAt->get($userId)) === null) {
            return [];
        }

        $result = [];

        foreach ($this->items as $item) {
            if ($item->getTimestamp() <= (float)$lastSeenAtForUser->getTimestamp()) {
                continue;
            }

            $result[] = $item;
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function onDecode(OnDecodeContext $context): void
    {
        $this->client = $context->getClient();
    }

    /**
     * Retrieve thread items by cursor.
     *
     * @param string|null $cursor
     * @return PromiseInterface<ThreadResponse|InstagramException>
     */
    protected function retrieveByCursor(?string $cursor = null): PromiseInterface
    {
        return $this->client->thread($this->threadId, $cursor);
    }
}
