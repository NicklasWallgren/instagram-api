<?php

namespace Instagram\SDK\DTO\Messages\Direct;

use Instagram\SDK\DTO\Direct\DirectSendItemPayload;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\Responses\Serializers\Traits\OnPropagateDecodeEventTrait;

/**
 * Class DirectSendItemMessage
 *
 * @package Instagram\SDK\DTO\Messages\Direct
 */
class DirectSendItemMessage extends Envelope
{

    use OnPropagateDecodeEventTrait;

    /**
     * @var string
     */
    protected $action;

    /**
     * @var string
     */
    protected $statusCode;

    /**
     * @var DirectSendItemPayload
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
     * @return DirectSendItemPayload
     */
    public function getPayload(): DirectSendItemPayload
    {
        return $this->payload;
    }
}
