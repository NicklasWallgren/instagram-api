<?php

namespace Instagram\SDK\DTO\Messages\Direct;

use Instagram\SDK\DTO\Direct\DirectSendItemPayload;
use Instagram\SDK\DTO\Envelope;

/**
 * Class DirectSendItemMessage
 *
 * @package Instagram\SDK\DTO\Messages\Direct
 */
final class DirectSendItemMessage extends Envelope
{

    /**
     * @var string
     */
    private $action;

    /**
     * @var string
     */
    private $statusCode;

    /**
     * @var DirectSendItemPayload
     */
    private $payload;

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
