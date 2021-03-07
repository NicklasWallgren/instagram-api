<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Responses\Direct;

use Instagram\SDK\Response\DTO\Direct\DirectSendItemPayload;
use Instagram\SDK\Response\Responses\ResponseEnvelope;

/**
 * Class DirectSendItemMessage
 *
 * @package Instagram\SDK\Response\Responses\Direct
 */
final class DirectSendItemResponse extends ResponseEnvelope
{

    /** @var string */
    private $action;

    /** @var string */
    private $statusCode;

    /** @var DirectSendItemPayload */
    private $payload;

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return string
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
