<?php

namespace Instagram\SDK\DTO\Direct;

use Exception;
use GuzzleHttp\Promise\Promise;
use Instagram\SDK\Client\Client;
use Instagram\SDK\Responses\Serializers\Interfaces\OnItemDecodeInterface;
use Instagram\SDK\Responses\Serializers\Traits\OnPropagateDecodeEventTrait;

/**
 * Class Inbox
 *
 * @package Instagram\SDK\DTO\Direct
 */
class Inbox implements OnItemDecodeInterface
{

    use OnPropagateDecodeEventTrait;

    /**
     * @var int
     * @name unseen_count
     */
    protected $unseenCount;

    /**
     * @var bool
     * @name has_older
     */
    protected $hasOlder;

    /**
     * @var double
     * @name unseen_count_timestamp
     */
    protected $unseenCountTimestamp;

    /**
     * @var \Instagram\SDK\DTO\Direct\Thread[]
     */
    protected $threads;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @return mixed
     */
    public function getUnseenCount()
    {
        return $this->unseenCount;
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
    public function getUnseenCountTimestamp()
    {
        return $this->unseenCountTimestamp;
    }

    /**
     * @return Thread[]
     */
    public function getThreads(): array
    {
        return $this->threads;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * Returns a thread by id.
     *
     * @param string $id
     * @param bool   $whole
     * @return Thread|Promise<Thread|null>|null
     */
    public function getThreadById(string $id, bool $whole = false)
    {
        foreach ($this->threads as $thread) {
            if ($thread->getThreadId() === $id) {
                return $whole ? $this->client->thread($id)->getThread() : $thread;
            }
        }

        return null;
    }

    /**
     * Returns a thread by title.
     *
     * @param string $title
     * @param bool   $whole
     * @return Thread|Promise<Thread|null>|null
     */
    public function getThreadByTitle(string $title, bool $whole = false)
    {
        foreach ($this->threads as $thread) {
            if ($thread->getThreadTitle() === $title) {
                return $whole ? $this->client->thread($thread->getThreadId())->getThread() : $thread;
            }
        }

        return null;
    }

    /**
     * Returns the unseen threads.
     *
     * @return array<string, ThreadItem[]>
     */
    public function getUnseen()
    {
        $result = [];

        foreach ($this->threads as $thread) {
            $result[$thread->getThreadId()] = $thread->getUnseenItems();
        }

        return $result;
    }

    /**
     * On item decode method.
     *
     * @suppress PhanUnusedPublicMethodParameter
     * @suppress PhanPossiblyNullTypeMismatchProperty
     * @param array<string, mixed>  $container
     * @param array<string, string> $requirements
     * @throws Exception
     */
    public function onDecode(array $container, $requirements = []): void
    {
        $this->client = $container['client'];

        $this->propagate($container);
    }
}
