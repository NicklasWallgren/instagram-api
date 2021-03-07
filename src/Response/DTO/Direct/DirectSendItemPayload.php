<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\DTO\Direct;

use Instagram\SDK\Response\DTO\DTO;

/**
 * Class DirectSendItemPayload
 *
 * @package Instagram\SDK\DTO\Direct
 */
final class DirectSendItemPayload extends DTO
{

    /** @var string */
    private $clientContext;

    /** @var string */
    private $message;

    /** @var string */
    private $itemId;

    /** @var string */
    private $timestamp;

    /** @var string */
    private $threadId;

    /**
     * @return string
     */
    public function getClientContext(): string
    {
        return $this->clientContext;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getItemId(): string
    {
        return $this->itemId;
    }

    /**
     * @return string
     */
    public function getTimestamp(): string
    {
        return $this->timestamp;
    }

    /**
     * @return string
     */
    public function getThreadId(): string
    {
        return $this->threadId;
    }
}
