<?php

namespace Instagram\SDK\DTO\Direct;

use Instagram\SDK\DTO\DTO;

/**
 * Class DirectSendItemPayload
 *
 * @package Instagram\SDK\DTO\Direct
 */
class DirectSendItemPayload extends DTO
{

    /**
     * @var string
     */
    protected $clientContext;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var string
     */
    protected $itemId;

    /**
     * @var string
     */
    protected $timestamp;

    /**
     * @var string
     */
    protected $threadId;

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
