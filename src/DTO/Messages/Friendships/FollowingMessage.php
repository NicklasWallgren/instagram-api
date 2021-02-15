<?php

namespace Instagram\SDK\DTO\Messages\Friendships;

use Exception;
use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\General\User;
use Instagram\SDK\Responses\Interfaces\IteratorInterface;
use function Instagram\SDK\Support\Promises\promise_for;

/**
 * Class FollowingMessage
 *
 * @package Instagram\SDK\DTO\Messages\Friendships
 */
class FollowingMessage extends Envelope implements IteratorInterface
{

    /**
     * @var string
     */
    private $userId;

    /**
     * @var User[]
     */
    private $users;

    /**
     * @var bool
     */
    private $bigList;

    /**
     * @var string|null
     */
    private $nextMaxId;

    /**
     * @var int
     */
    private $pageSize;

    /**
     * @var Client
     */
    private $client;

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     * @return static
     */
    public function setUserId(string $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return User[]
     */
    public function getUsers(): array
    {
        return $this->users;
    }

    /**
     * @return bool
     */
    public function getBigList(): bool
    {
        return $this->bigList;
    }

    /**
     * @return string|null
     */
    public function getNextMaxId(): ?string
    {
        return $this->nextMaxId;
    }

    /**
     * @return int
     */
    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    /**
     * @return FollowersMessage|null
     */
    public function next(): ?FollowersMessage
    {
        // Check whether the are any more items to be fetched
        if (!$this->bigList) {
            return null;
        }

        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return $this->client->followers($this->userId, $this->nextMaxId)->wait();
    }

    /**
     * @return PromiseInterface<FollowersMessage>
     */
    public function nextPromise(): PromiseInterface
    {
        // Check whether the are any more items to be fetched
        if (!$this->bigList) {
            return promise_for(null);
        }

        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return $this->client->followers($this->userId, $this->nextMaxId);
    }

    public function rewind()
    {
        return $this->rewindPromise()->wait();
    }

    public function rewindPromise(): PromiseInterface
    {
        return rejection_for('not implemented yet.');
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
