<?php

namespace Instagram\SDK\DTO\Messages\Direct;

use Instagram\SDK\DTO\Direct\Inbox;
use Instagram\SDK\DTO\Envelope;
use Tebru\Gson\Annotation\JsonAdapter;

/**
 * Class InboxMessage
 *
 * @package Instagram\SDK\DTO\Messages\Direct
 */
final class InboxMessage extends Envelope
{

    /**
     * The logged in user property.
     *
     * @var Inbox
     * @JsonAdapter("Instagram\SDK\DTO\Adapters\TestAdapterFactory")
     */
    private $inbox;

    /**
     * @var int
     */
    private $seqId;

    /**
     * @var mixed
     */
    private $subscription;

    /**
     * @var int
     */
    private $pendingRequestsTotal;

    /**
     * @var mixed // TODO
     */
    private $pendingRequestsUsers;

    /**
     * @return Inbox
     */
    public function getInbox(): Inbox
    {
        return $this->inbox;
    }

    /**
     * @return mixed
     */
    public function getSeqId()
    {
        return $this->seqId;
    }

    /**
     * @return mixed
     */
    public function getPendingRequestsTotal()
    {
        return $this->pendingRequestsTotal;
    }
}
