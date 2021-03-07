<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Responses\Direct;

use Instagram\SDK\Response\DTO\Direct\Inbox;
use Instagram\SDK\Response\Responses\ResponseEnvelope;
use Tebru\Gson\Annotation\JsonAdapter;

/**
 * Class InboxMessage
 *
 * @package Instagram\SDK\Response\Responses\Direct
 */
final class InboxResponse extends ResponseEnvelope
{

    /**
     * @var Inbox
     * @JsonAdapter("Instagram\SDK\Response\DTO\Adapters\OnResponseDecodePropagatorAdapterFactory")
     */
    private $inbox;

    /** @var int */
    private $pendingRequestsTotal;

    /**
     * @return Inbox
     */
    public function getInbox(): Inbox
    {
        return $this->inbox;
    }

    /**
     * @return int
     */
    public function getPendingRequestsTotal(): int
    {
        return $this->pendingRequestsTotal;
    }
}
