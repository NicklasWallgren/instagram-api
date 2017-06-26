<?php

namespace NicklasW\Instagram\DTO\Messages\Direct;

use NicklasW\Instagram\DTO\Envelope;
use NicklasW\Instagram\Responses\Serializers\Traits\OnPropagateDecodeEventTrait;
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
     * @var \NicklasW\Instagram\DTO\Direct\DirectSendItemPayload
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
     * @return \NicklasW\Instagram\DTO\Direct\DirectSendItemPayload
     */
    public function getPayload(): \NicklasW\Instagram\DTO\Direct\DirectSendItemPayload
    {
        return $this->payload;
    }
}
