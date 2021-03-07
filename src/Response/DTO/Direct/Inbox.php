<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\DTO\Direct;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Client\Client;
use Instagram\SDK\Exceptions\InstagramException;
use Instagram\SDK\Response\DTO\Adapters\OnDecodeContext;
use Instagram\SDK\Response\DTO\Interactive;
use Instagram\SDK\Response\Responses\Direct\ThreadResponse;
use Instagram\SDK\Response\Serializers\Interfaces\OnResponseDecodeInterface;
use Instagram\SDK\Utils\PromiseUtils;
use Tebru\Gson\Annotation\JsonAdapter;

/**
 * Class Inbox
 *
 * @package Instagram\SDK\Response\DTO\Direct
 */
final class Inbox extends Interactive implements OnResponseDecodeInterface
{

    /** @var int */
    private $unseenCount;

    /** @var bool */
    private $hasOlder;

    /** @var float */
    private $unseenCountTimestamp;

    /**
     * @var Thread[]
     * @JsonAdapter("Instagram\SDK\Response\DTO\Direct\Adapters\ThreadAdapterFactory")
     */
    private $threads;

    public function getUnseenCount(): int
    {
        return $this->unseenCount;
    }

    public function getHasOlder(): bool
    {
        return $this->hasOlder;
    }

    public function getUnseenCountTimestamp(): float
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
     * @return Thread|null
     * @throws InstagramException
     */
    public function getThreadById(string $id): ?Thread
    {
        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return PromiseUtils::wait($this->getThreadByIdPromise($id));
    }

    /**
     * Returns a thread by id.
     *
     * @param string $id
     * @return PromiseInterface<ThreadResponse|InstagramException>
     */
    public function getThreadByIdPromise(string $id): PromiseInterface
    {
        return $this->client->thread($id);
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
     * @inheritDoc
     */
    public function onDecode(OnDecodeContext $context): void
    {
        $this->client = $context->getClient();
    }
}
