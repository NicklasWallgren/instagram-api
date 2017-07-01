<?php

namespace Instagram\SDK\DTO\Messages\Direct;

use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\Responses\Serializers\Traits\OnPropagateDecodeEventTrait;
use Traits\MappableTrait;

class DirectSendItemMessage extends Envelope
{

    use MappableTrait;
    use OnPropagateDecodeEventTrait;

    /**
     * @var string
     */
    protected $action;

    /**
     * @var string
     * @name status_code
     */
    protected $statusCode;

    /**
     * @var \Instagram\SDK\DTO\Direct\DirectSendItemPayload
     */
    protected $payload;

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return \Instagram\SDK\DTO\Direct\DirectSendItemPayload
     */
    public function getPayload(): \Instagram\SDK\DTO\Direct\DirectSendItemPayload
    {
        return $this->payload;
    }
}
