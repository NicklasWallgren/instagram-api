<?php

namespace Instagram\SDK\DTO\Direct;

use Instagram\SDK\DTO\Cursor\RequestIterator;
use Instagram\SDK\DTO\Direct\Collections\LastSeenAtCollection;
use Instagram\SDK\DTO\General\ItemType;
use Instagram\SDK\DTO\Messages\Direct\SeenMessage;
use Instagram\SDK\Responses\Serializers\Interfaces\OnItemDecodeInterface;
use Instagram\SDK\Responses\Serializers\Traits\OnPropagateDecodeEventTrait;
use Instagram\SDK\Support\Promise;
use function Instagram\SDK\Support\Promises\task;
use function Instagram\SDK\Support\Promises\unwrap;

/**
 * Class Thread
 *
 * @package            Instagram\SDK\DTO\Direct
 * @phan-file-suppress PhanUnextractableAnnotation, PhanPluginUnknownPropertyType
 */
class Thread extends RequestIterator implements OnItemDecodeInterface
{

    use OnPropagateDecodeEventTrait;

    /**
     * @var string
     * @name thread_id
     */
    protected $threadId;

    /**
     * @var \Instagram\SDK\DTO\General\User[]
     */
    protected $users = [];

    /**
     * @var \Instagram\SDK\DTO\General\User[]
     * @name left_users
     */
    protected $leftUsers = [];

    /**
     * @var \Instagram\SDK\DTO\Direct\ThreadItem[]
     */
    protected $items;

    /**
     * @var string
     * @name thread_title
     */
    protected $threadTitle;

    /**
     * @var double
     * @name last_activity_at
     */
    protected $lastActivityAt;

    /**
     * @var bool
     */
    protected $muted;

    /**
     * @var bool
     */
    protected $named;

    /**
     * @var bool
     */
    protected $canonical;

    /**
     * @var bool
     */
    protected $pending;

    /**
     * @var string
     * @name thread_type
     */
    protected $threadType;

    /**
     * @var int
     * @name viewer_id
     */
    protected $viewerId;

    /**
     * @var bool
     * @name has_older
     */
    protected $hasOlder;

    /**
     * @var bool
     * @name has_newer
     */
    protected $hasNewer;

    /**
     * Not able to define @var, due to the limitation of the json-mapper.
     *
     * @name last_seen_at
     */
    protected $lastSeenAt;

    /**
     * @var string
     * @name newest_cursor
     */
    protected $newestCursor;

    /**
     * @var string
     * @name oldest_cursor
     */
    protected $oldestCursor;

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
     * @return \Instagram\SDK\DTO\General\User[]
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
     * @return \Instagram\SDK\DTO\Direct\LastSeenAt[]
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
     * @param mixed $threadId
     * @return $this
     */
    public function setThreadId($threadId)
    {
        $this->threadId = $threadId;

        return $this;
    }

    /**
     * @param \Instagram\SDK\DTO\General\User[] $users
     * @return $this
     */
    public function setUsers(array $users)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @param mixed $leftUsers
     * @return $this
     */
    public function setLeftUsers($leftUsers)
    {
        $this->leftUsers = $leftUsers;

        return $this;
    }

    /**
     * @param ThreadItem[] $items
     * @return $this
     */
    public function setItems(array $items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @param mixed $threadTitle
     * @return $this
     */
    public function setThreadTitle($threadTitle)
    {
        $this->threadTitle = $threadTitle;

        return $this;
    }

    /**
     * @param mixed $lastActivityAt
     * @return $this
     */
    public function setLastActivityAt($lastActivityAt)
    {
        $this->lastActivityAt = $lastActivityAt;

        return $this;
    }

    /**
     * @param bool $muted
     * @return $this
     */
    public function setMuted(bool $muted)
    {
        $this->muted = $muted;

        return $this;
    }

    /**
     * @param bool $named
     * @return $this
     */
    public function setNamed(bool $named)
    {
        $this->named = $named;

        return $this;
    }

    /**
     * @param bool $canonical
     * @return $this
     */
    public function setCanonical(bool $canonical)
    {
        $this->canonical = $canonical;

        return $this;
    }

    /**
     * @param bool $pending
     * @return $this
     */
    public function setPending(bool $pending)
    {
        $this->pending = $pending;

        return $this;
    }

    /**
     * @param mixed $threadType
     * @return $this
     */
    public function setThreadType($threadType)
    {
        $this->threadType = $threadType;

        return $this;
    }

    /**
     * @param mixed $viewerId
     * @return $this
     */
    public function setViewerId($viewerId)
    {
        $this->viewerId = $viewerId;

        return $this;
    }

    /**
     * @param mixed $hasOlder
     * @return $this
     */
    public function setHasOlder($hasOlder)
    {
        $this->hasOlder = $hasOlder;

        return $this;
    }

    /**
     * @param mixed $hasNewer
     * @return $this
     */
    public function setHasNewer($hasNewer)
    {
        $this->hasNewer = $hasNewer;

        return $this;
    }

    /**
     * @param mixed $newestCursor
     * @return $this
     */
    public function setNewestCursor($newestCursor)
    {
        $this->newestCursor = $newestCursor;

        return $this;
    }

    /**
     * @param mixed $oldestCursor
     * @return $this
     */
    public function setOldestCursor($oldestCursor)
    {
        $this->oldestCursor = $oldestCursor;

        return $this;
    }

    /**
     * Retrieves the whole thread with thread items.
     *
     * @return bool|Promise<bool>
     */
    public function whole()
    {
        // @phan-suppress-next-line PhanPluginUnknownClosureReturnType
        return task(function () {
            return $this->retrieve();
        })($this->client->getMode());
    }

    /**
     * Step forward and get the next items in thread.
     *
     * @return bool|Promise<bool>
     */
    public function next()
    {
        // @phan-suppress-next-line PhanPluginUnknownClosureReturnType
        return task(function () {
            // Check whether there are any older posts
            if (!$this->getHasOlder()) {
                return false;
            }

            return $this->retrieve($this->oldestCursor);
        })($this->client->getMode());
    }

    /**
     * Step backward and get the previous items in thread.
     *
     * @return bool|Promise<bool>
     */
    public function rewind()
    {
        // @phan-suppress-next-line PhanPluginUnknownClosureReturnType
        return task(function () {
            // Check whether there are any newer posts
            if (!$this->getHasNewer()) {
                return false;
            }

            return $this->retrieve($this->newestCursor);
        })($this->client->getMode());
    }

    /**
     * Sends a message to the thread.
     *
     * @param string $text
     * @phan-suppress PhanPluginMixedKeyNoKey
     * @return bool|Promise<bool>
     */
    public function sendMessage(string $text)
    {
        // @phan-suppress-next-line PhanPluginUnknownClosureReturnType
        $promise = task(function () use ($text) {
            return $this->client->sendThreadMessage($text, $this->threadId);
        });

        // phpcs:ignore
        // @phan-suppress-next-line PhanPluginMixedKeyNoKey, PhanPluginUnknownClosureReturnType, PhanPluginUnknownClosureParamType
        return $promise->then(function ($promise) use ($text) {
            $message = unwrap($promise);

            // Check if the message was successful
            if (!$message->isSuccess()) {
                return false;
            }

            // Build the thread item
            $item = ThreadItem::create([
                // @phan-suppress-next-line PhanPluginMixedKeyNoKey
                'itemType' => ItemType::TEXT,
                'user'     => $this->getSender(),
                'text'     => $text,
                $message->getPayload(),
            ]);

            $this->items[] = $item;

            return true;
        })($this->client->getMode());
    }

    /**
     * Sets the thread, or thread id as seen.
     *
     * @param string|null $threadItemId
     * @return SeenMessage|Promise<SeenMessage>
     */
    public function seen(?string $threadItemId = null)
    {
        /**
         * @var ThreadItem $latestItem
         */
        $latestItem = current($this->items);

        return $this->client->seen($this->threadId, $threadItemId ?? $latestItem->getItemId());
    }

    /**
     * Refresh the thread with the latest updates.
     *
     * @suppress PhanPluginUnknownClosureReturnType
     * @return bool|Promise<bool>
     */
    public function refresh()
    {
        // @phan-suppress-next-line PhanPluginUnknownClosureReturnType
        return task(function () {
            return $this->retrieve();
        })($this->client->getMode());
    }

    /**
     * Retrieve thread items by cursor.
     *
     * @param string|null $cursor
     * @return bool|Promise<bool>
     */
    protected function retrieve(?string $cursor = null)
    {
        // Query for thread items by cursor
        // @phan-suppress-next-line PhanPluginUnknownClosureReturnType
        $promise = task(function () use ($cursor) {
            return $this->client->thread($this->threadId, $cursor);
        });

        // @phan-suppress-next-line PhanPluginUnknownClosureReturnType, PhanPluginUnknownClosureParamType
        return $promise->then(function ($promise) {
            $message = unwrap($promise);

            // Check if we successfully retrieved additional thread items
            if (!$message->isSuccess()) {
                return false;
            }

            // Retrieve the thread
            $thread = $message->getThread();

            $this->setNewestCursor($thread->getNewestCursor())
                ->setOldestCursor($thread->getOldestCursor())
                ->setItems($thread->getItems())
                ->setHasOlder($thread->getHasOlder())
                ->setHasNewer($thread->getHasNewer());

            return true;
        })($this->client->getMode());
    }

    /**
     * Returns unseen items for the user.
     *
     * @param string|null $userId
     * @return ThreadItem[]
     */
    public function getUnseenItems(?string $userId = null): array
    {
        $userId = $userId ?? $this->viewerId;

        /**
         * @var $lastSeenAt LastSeenAtCollection
         */
        $lastSeenAt = $this->lastSeenAt;

        if (($lastSeenAtForUser = $lastSeenAt->get($userId)) === null) {
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
     * @param array $container
     * @param array $requirements
     * @throws \Exception
     */
    public function onDecode(array $container, $requirements = []): void
    {
        $this->client = $container['client'];

        $this->propagate($container);
    }

    /**
     * On decode users.
     *
     * @return void
     */
    protected function onDecodeUsers()
    {
        // Group by user id
        foreach ($this->users as $index => $user) {
            $this->users[$user->getId()] = $user;

            unset($this->users[$index]);
        }
    }

    /**
     * On decode users.
     *
     * @return void
     */
    protected function onDecodeLeftUsers()
    {
        // Group by user id
        foreach ($this->leftUsers as $index => $user) {
            $this->leftUsers[$user->getId()] = $user;

            unset($this->leftUsers[$index]);
        }
    }

    /**
     * On decode of last seen at property.
     *
     * @return void
     */
    protected function onDecodeLastSeenAt()
    {
        $result = [];

        foreach ($this->lastSeenAt as $userId => $item) {
            $result[$userId] = $item = new LastSeenAt($item->timestamp, $item->item_id);
        }

        $this->lastSeenAt = new LastSeenAtCollection($result);
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

    /**
     * Returns the user by id.
     *
     * @param int $userId
     * @return \Instagram\SDK\DTO\General\User|\Instagram\SDK\DTO\Session\User|null
     */
    protected function getUser(int $userId)
    {
        // Check whether the user id corresponds to an active thread user
        if (array_key_exists($userId, $this->users)) {
            return $this->users[$userId];
        }

        // Check whether the user id corresponds to an inactive thread user
        if (array_key_exists($userId, $this->leftUsers)) {
            return $this->leftUsers[$userId];
        }

        // Retrieve the logged in user
        $user = $this->client->getSession()->getUser();

        return $user->getId() == $userId ? $user : null;
    }
}
