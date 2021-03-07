<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Responses\Direct;

use Instagram\SDK\Response\DTO\Direct\DirectSendItem;
use Instagram\SDK\Response\Responses\ResponseEnvelope;

/**
 * Class DirectSendItemResponse
 *
 * @package Instagram\SDK\Response\Responses\Direct
 */
final class DirectSendItemResponse extends ResponseEnvelope
{

    /** @var string */
    private $action;

    /** @var string */
    private $statusCode;

    /** @var DirectSendItem */
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
     * @return DirectSendItem
     */
    public function getPayload(): DirectSendItem
    {
        return $this->payload;
    }
}
