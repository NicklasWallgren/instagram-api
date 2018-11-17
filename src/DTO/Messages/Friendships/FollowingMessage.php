<?php

namespace Instagram\SDK\DTO\Messages\Friendships;

use Exception;
use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\Traits\Inflatable;
use Instagram\SDK\Responses\Interfaces\IteratorInterface;
use Instagram\SDK\Support\Promise;
use function Instagram\SDK\Support\Promises\task;
use function Instagram\SDK\Support\Promises\unwrap;

/**
 * Class FollowingMessage
 *
 * @package Instagram\SDK\DTO\Messages\Friendships
 */
class FollowingMessage extends Envelope implements IteratorInterface
{

    use Inflatable;

    /**
     * @var string
     */
    protected $userId;

    /**
     * @var \Instagram\SDK\DTO\General\User[]
     */
    protected $users;

    /**
     * @var bool
     * @name big_list
     */
    protected $bigList;

    /**
     * @var string|null
     * @name next_max_id
     */
    protected $nextMaxId;

    /**
     * @var int
     * @name page_size
     */
    protected $pageSize;

    /**
     * @var Client
     */
    protected $client;

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
     * @return \Instagram\SDK\DTO\General\User[]
     */
    public function getUsers(): array
    {
        return $this->users;
    }

    /**
     * @param \Instagram\SDK\DTO\General\User[] $users
     * @return static
     */
    public function setUsers(array $users): self
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @return bool
     */
    public function getBigList(): bool
    {
        return $this->bigList;
    }

    /**
     * @param bool $bigList
     * @return static
     */
    public function setBigList(bool $bigList): self
    {
        $this->bigList = $bigList;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNextMaxId(): ?string
    {
        return $this->nextMaxId;
    }

    /**
     * @param string|null $nextMaxId
     * @return static
     */
    public function setNextMaxId(?string $nextMaxId): self
    {
        $this->nextMaxId = $nextMaxId;

        return $this;
    }

    /**
     * @return int
     */
    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    /**
     * @param int $pageSize
     * @return static
     */
    public function setPageSize(int $pageSize): self
    {
        $this->pageSize = $pageSize;

        return $this;
    }

    /**
     * @suppress PhanPluginUnknownClosureReturnType
     * @return bool|Promise<bool>
     */
    public function next()
    {
        $promise = task(function () {
            // Check whether the are any more items to be fetched
            if (!$this->bigList) {
                return false;
            }

            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            return $this->client->followers($this->userId, $this->nextMaxId);
        });

        // @phan-suppress-next-line PhanPluginUnknownClosureParamType
        return $promise->then(function ($promise) {
            $message = unwrap($promise);

            // Check if the message was successful
            if (!$message->isSuccess()) {
                return false;
            }

            // Update the feed message
            $this->inflate($message);

            return true;
        })($this->client->getMode());
    }

    /**
     * @return bool
     */
    public function rewind()
    {
        // TODO

        return true;
    }

    /**
     * On item decode method.
     *
     * @suppress PhanUnusedPublicMethodParameter
     * @suppress PhanPossiblyNullTypeMismatchProperty
     * @param array $container
     * @param array $requirements
     * @throws Exception
     */
    public function onDecode(array $container, $requirements = []): void
    {
        $this->client = $container['client'];

        $this->propagate($container);
    }
}
