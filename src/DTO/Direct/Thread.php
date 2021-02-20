<?php

namespace Instagram\SDK\DTO\Direct;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\DTO\Cursor\RequestIterator;
use Instagram\SDK\DTO\Direct\Collections\LastSeenAtCollection;
use Instagram\SDK\DTO\General\User;
use Instagram\SDK\DTO\Messages\Direct\DirectSendItemMessage;
use Instagram\SDK\DTO\Messages\Direct\SeenMessage;
use Instagram\SDK\DTO\Messages\Direct\ThreadMessage;
use Instagram\SDK\Responses\Serializers\Interfaces\OnDecodeInterface;
use Tebru\Gson\Annotation\JsonAdapter;
use function GuzzleHttp\Promise\promise_for;

/**
 * Class Thread
 *
 * @package            Instagram\SDK\DTO\Direct
 * @phan-file-suppress PhanUnextractableAnnotation, PhanPluginUnknownPropertyType, PhanUnreferencedUseNormal
 */
final class Thread extends RequestIterator implements OnDecodeInterface
{

    /**
     * @var string
     */
    private $threadId;

    /**
     * @var User[]
     * @JsonAdapter("Instagram\SDK\DTO\Adapters\TestAdapterFactory")
     */
    private $users = [];

    /**
     * @var User[]
     * @JsonAdapter("Instagram\SDK\DTO\Adapters\TestAdapterFactory")
     */
    private $leftUsers = [];

    /**
     * @var ThreadItem[]
     * @JsonAdapter("Instagram\SDK\DTO\Adapters\TestAdapterFactory") // TODO, parent?
     */
    private $items;

    /**
     * @var string
     */
    private $threadTitle;

    /**
     * @var double
     */
    private $lastActivityAt;

    /**
     * @var bool
     */
    private $muted;

    /**
     * @var bool
     */
    private $named;

    /**
     * @var bool
     */
    private $canonical;

    /**
     * @var bool
     */
    private $pending;

    /**
     * @var string
     */
    private $threadType;

    /**
     * @var int
     */
    private $viewerId;

    /**
     * @var bool
     */
    private $hasOlder;

    /**
     * @var bool
     */
    private $hasNewer;

    /**
     * @var LastSeenAtCollection<LastSeenAt>
     * @JsonAdapter("Instagram\SDK\DTO\Direct\Adapters\LastSeenAtAdapter")
     */
    private $lastSeenAt;

    /**
     * @var string
     */
    private $newestCursor;

    /**
     * @var string
     */
    private $oldestCursor;

    /**
     * Returns the thread items.
     *
     * @return ThreadItem[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @return string
     */
    public function getThreadId()
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
     * @return mixed
     */
    public function getLeftUsers()
    {
        return $this->leftUsers;
    }

    /**
     * @return mixed
     */
    public function getThreadTitle()
    {
        return $this->threadTitle;
    }

    /**
     * @return mixed
     */
    public function getLastActivityAt()
    {
        return $this->lastActivityAt;
    }

    /**
     * @return bool
     */
    public function isMuted(): bool
    {
        return $this->muted;
    }

    /**
     * @return bool
     */
    public function isNamed(): bool
    {
        return $this->named;
    }

    /**
     * @return bool
     */
    public function isCanonical(): bool
    {
        return $this->canonical;
    }

    /**
     * @return bool
     */
    public function isPending(): bool
    {
        return $this->pending;
    }

    /**
     * @return mixed
     */
    public function getThreadType()
    {
        return $this->threadType;
    }

    /**
     * @return mixed
     */
    public function getViewerId()
    {
        return $this->viewerId;
    }

    /**
     * @return mixed
     */
    public function getHasOlder()
    {
        return $this->hasOlder;
    }

    /**
     * @return mixed
     */
    public function getHasNewer()
    {
        return $this->hasNewer;
    }

    /**
     * @return LastSeenAtCollection<LastSeenAt>
     */
    public function getLastSeenAt()
    {
        return $this->lastSeenAt;
    }

    /**
     * @return mixed
     */
    public function getNewestCursor()
    {
        return $this->newestCursor;
    }

    /**
     * @return mixed
     */
    public function getOldestCursor()
    {
        return $this->oldestCursor;
    }

    /**
     * Retrieves the whole thread with thread items.
     *
     * @return ThreadMessage
     */
    public function whole(): ThreadMessage
    {
        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return $this->retrieveByCursor()->wait();
    }

    /**
     * Retrieves the whole thread with thread items.
     *
     * @return PromiseInterface<ThreadMessage>
     */
    public function wholePromise(): PromiseInterface
    {
        return $this->retrieveByCursor();
    }

    /**
     * Step forward and get the next items in thread.
     *
     * @return ThreadMessage|null
     */
    public function next(): ?ThreadMessage
    {
        // Check whether there are any older posts
        if (!$this->getHasOlder()) {
            return null;
        }

        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return $this->retrieveByCursor($this->oldestCursor)->wait();
    }

    /**
     * Step forward and get the next items in thread.
     *
     * @return PromiseInterface<ThreadMessage|null>
     */
    public function nextPromise(): PromiseInterface
    {
        // Check whether there are any older posts
        if (!$this->getHasOlder()) {
            return promise_for(null);
        }

        return $this->retrieveByCursor($this->oldestCursor);
    }

    /**
     * Step backward and get the previous items in thread.
     *
     * @return ThreadMessage|null
     */
    public function rewind(): ?ThreadMessage
    {
        // Check whether there are any newer posts
        if (!$this->getHasNewer()) {
            return null;
        }

        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return $this->retrieveByCursor($this->newestCursor)->wait();
    }

    /**
     * Step backward and get the previous items in thread.
     *
     * @return PromiseInterface<ThreadMessage>
     */
    public function rewindPromise(): PromiseInterface
    {
        // Check whether there are any newer posts
        if (!$this->getHasNewer()) {
            return promise_for(null);
        }

        return $this->retrieveByCursor($this->newestCursor);
    }

    /**
     * Sends a message to the thread.
     *
     * @param string $text
     * @return DirectSendItemMessage
     */
    public function sendMessage(string $text): DirectSendItemMessage
    {
        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return $this->sendMessagePromise($text)->wait();
    }

    /**
     * Sends a message to the thread.
     *
     * @param string $text
     * @phan-suppress PhanPluginMixedKeyNoKey
     * @return PromiseInterface<DirectSendItemMessage>
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
     * @return SeenMessage
     */
    public function seen(?string $threadItemId = null): SeenMessage
    {
        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return $this->seenPromise($threadItemId)->wait();
    }

    /**
     * Sets the thread, or thread id as seen.
     *
     * @param string|null $threadItemId
     * @return PromiseInterface<SeenMessage>
     */
    public function seenPromise(?string $threadItemId = null): PromiseInterface
    {
        /** @var ThreadItem $latestItem */
        $latestItem = current($this->items);

        return $this->client->seen($this->threadId, $threadItemId ?? $latestItem->getItemId());
    }

    /**
     * Refresh the thread with the latest updates.
     *
     * @suppress PhanPluginUnknownClosureReturnType
     * @return ThreadMessage
     */
    public function refresh(): ThreadMessage
    {
        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return $this->refreshPromise()->wait();
    }

    /**
     * Refresh the thread with the latest updates.
     *
     * @suppress PhanPluginUnknownClosureReturnType
     * @return PromiseInterface<ThreadMessage>
     */
    public function refreshPromise(): PromiseInterface
    {
        return $this->retrieveByCursor();
    }

    /**
     * Retrieve thread items by cursor.
     *
     * @param string|null $cursor
     * @return PromiseInterface<ThreadMessage>
     */
    protected function retrieveByCursor(?string $cursor = null): PromiseInterface
    {
        return $this->client->thread($this->threadId, $cursor);
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
     * On item decode method.
     *
     * @suppress PhanUnusedPublicMethodParameter
     * @suppress PhanPossiblyNullTypeMismatchProperty
     * @param array<string, mixed> $container
     */
    public function onDecode(array $container): void
    {
        $this->client = $container['client'];
    }

    /**
     * Returns the sender.
     *
     * @return \Instagram\SDK\DTO\Session\User
     */
    protected function getSender()
    {
        return $this->client->getSession()->getUser();
    }
}
