<?php

namespace Instagram\SDK\DTO\Direct;

use Instagram\SDK\DTO\DTO;

/**
 * Class DirectSendItemPayload
 *
 * @package Instagram\SDK\DTO\Direct
 */
final class DirectSendItemPayload extends DTO
{

    /**
     * @var string
     */
    private $clientContext;

    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $itemId;

    /**
     * @var string
     */
    private $timestamp;

    /**
     * @var string
     */
    private $threadId;

    /**
     * @return mixed
     */
    public function getClientContext()
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
     * @return mixed
     */
    public function getItemId()
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
