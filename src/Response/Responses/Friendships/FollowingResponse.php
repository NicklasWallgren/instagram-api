<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Responses\Friendships;

use Exception;
use GuzzleHttp\Promise\Create;
use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Client\Client;
use Instagram\SDK\Exceptions\InstagramException;
use Instagram\SDK\Response\DTO\General\User;
use Instagram\SDK\Response\Interfaces\IteratorInterface;
use Instagram\SDK\Response\Responses\ResponseEnvelope;
use Instagram\SDK\Utils\PromiseUtils;

/**
 * Class FollowingMessage
 *
 * @package Instagram\SDK\Response\Responses\Friendships
 */
final class FollowingResponse extends ResponseEnvelope implements IteratorInterface
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
     * FollowingResponse constructor.
     *
     * @param string $userId
     */
    public function __construct(string $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
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
     * @return FollowersResponse|null
     */
    public function next(): ?FollowersResponse
    {
        // Check whether the are any more items to be fetched
        if (!$this->bigList) {
            return null;
        }

        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return PromiseUtils::wait($this->client->followers($this->userId, $this->nextMaxId));
    }

    /**
     * @return PromiseInterface<FollowersResponse|InstagramException>
     */
    public function nextPromise(): PromiseInterface
    {
        // Check whether the are any more items to be fetched
        if (!$this->bigList) {
            return Create::promiseFor(null);
        }

        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return $this->client->followers($this->userId, $this->nextMaxId);
    }

    public function rewind()
    {
        return PromiseUtils::wait($this->rewindPromise());
    }

    public function rewindPromise(): PromiseInterface
    {
        return Create::rejectionFor('not implemented yet.');
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
    }
}
