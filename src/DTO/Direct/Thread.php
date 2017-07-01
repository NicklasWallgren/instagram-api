<?php

namespace Instagram\SDK\DTO\Direct;

use GuzzleHttp\Promise\Promise;
use Instagram\SDK\DTO\Cursor\RequestIterator;
use Instagram\SDK\DTO\General\ItemType;
use Instagram\SDK\Responses\Serializers\Interfaces\OnItemDecodeInterface;
use Instagram\SDK\Responses\Serializers\Traits\OnPropagateDecodeEventTrait;
use function GuzzleHttp\Promise\task;
use function Instagram\SDK\Support\unwrap;

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
     * @return mixed
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
        return $this->client->getAdapter()->run(function () {
            return $this->retrieve();
        });
    }

    /**
     * Step forward and get the next items in thread.
     *
     * @return bool|Promise<bool>
     */
    public function next()
    {
        // Check whether there are any older posts
        if (!$this->getHasOlder()) {
            return false;
        }

        return $this->client->getAdapter()->run(function () {
            return $this->retrieve($this->oldestCursor);
        });
    }

    /**
     * Step backward and get the previous items in thread.
     *
     * @return bool|Promise<bool>
     */
    public function rewind()
    {
        // Check whether there are any newer posts
        if (!$this->getHasNewer()) {
            return false;
        }

        return $this->client->getAdapter()->run(function () {
            return $this->retrieve($this->newestCursor);
        });
    }

    /**
     * Sends a message to the thread.
     *
     * @param string $text
     * @return bool|Promise<bool>
     */
    public function sendMessage(string $text)
    {
        $promise = task(function () use ($text) {
            return $this->sendThreadMessage($text, $this->threadId);
        });

        return $promise->then(function ($promise) use ($text) {
            $message = unwrap($promise);

            // Check if the message was successful
            if (!$message->isSuccess()) {
                return false;
            }

            // Build the thread item
            $item = ThreadItem::create([
                'itemType' => ItemType::TEXT,
                'user'     => $this->getSender(),
                'text'     => $text,
                $message->getPayload(),
            ]);

            $this->items[] = $item;

            return true;
        });
    }

    /**
     * Retrieve thread items by cursor.
     *
     * @param string $cursor
     * @return bool|Promise<bool>
     */
    protected function retrieve(?string $cursor = null)
    {
        // Query for thread items by cursor
        $promise = task(function () use ($cursor) {
            return $this->thread($this->threadId, $cursor);
        });

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
        });
    }

    /**
     * On item decode method.
     *
     * @param array $container
     * @param array $requirements
     */
    public function onDecode(array $container, $requirements = []): void
    {
        $this->client = $container['client'];

        $this->propagate($container);
    }

    /**
     * On decode users.
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
     * @return \Instagram\SDK\DTO\General\User|null
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
