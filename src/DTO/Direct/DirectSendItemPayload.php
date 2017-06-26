<?php

namespace NicklasW\Instagram\DTO\Direct;

use NicklasW\Instagram\DTO\DTO;

class DirectSendItemPayload extends DTO
{

    /**
     * @var string
     * @name client_context
     */
    protected $clientContext;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var string
     * @name item_id
     */
    protected $itemId;

    /**
     * @var string
     */
    protected $timestamp;

    /**
     * @var string
     * @name thread_id
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
