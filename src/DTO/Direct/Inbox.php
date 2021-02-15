<?php

namespace Instagram\SDK\DTO\Direct;

use Exception;
use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Messages\Direct\ThreadMessage;
use Instagram\SDK\Responses\Serializers\Interfaces\OnItemDecodeInterface;
use Instagram\SDK\Responses\Serializers\Traits\OnPropagateDecodeEventTrait;
use function Instagram\SDK\Support\Promises\promise_for;

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
     */
    private $unseenCount;

    /**
     * @var bool
     */
    private $hasOlder;

    /**
     * @var double
     */
    private $unseenCountTimestamp;

    /**
     * @var \Instagram\SDK\DTO\Direct\Thread[]
     */
    private $threads;

    /**
     * @var Client
     */
    private $client;

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
     * @return Thread|null
     */
    public function getThreadById(string $id, bool $whole = false): ?Thread
    {
        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return $this->getThreadByIdPromise($id, $whole)->wait();
    }

    /**
     * Returns a thread by id.
     *
     * @param string $id
     * @param bool   $whole
     * @return PromiseInterface<Thread|null>
     */
    public function getThreadByIdPromise(string $id, bool $whole = false): PromiseInterface
    {
        foreach ($this->threads as $thread) {
            if ($thread->getThreadId() === $id) {
                if ($whole) {
                    return $this->client->thread($id)->then(function (ThreadMessage $threadMessage): Thread {
                        return $threadMessage->getThread();
                    });
                }
                return promise_for($thread);
            }
        }

        return promise_for(null);
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
                // @phan-suppress-next-line PhanThrowTypeAbsentForCall
                return $whole ? $this->client->thread($thread->getThreadId())->wait()->getThread() : $thread;
            }
        }

        return null;
    }

    /**
     * Returns a thread by title.
     *
     * @param string $title
     * @param bool   $whole
     * @return PromiseInterface<Thread|null>
     */
    public function getThreadByTitlePromise(string $title, bool $whole = false): PromiseInterface
    {
        foreach ($this->threads as $thread) {
            if ($thread->getThreadTitle() === $title) {
                if ($whole) {
                    return $this->client->thread($thread->getThreadId())->then(function (ThreadMessage $threadMessage): Thread {
                        return $threadMessage->getThread();
                    });
                }
                return promise_for($thread);
            }
        }

        return promise_for(null);
    }

    /**
     * Returns the unseen threads.
     *
     * @return array<string, ThreadItem[]>
     */
    public function getUnseen(): array
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
     * @param array<string, mixed> $container
     * @throws Exception
     */
    public function onDecode(array $container): void
    {
        $this->client = $container['client'];

        $this->propagate($container);
    }
}
