<?php

namespace Instagram\SDK\DTO\Messages\Direct;

use Instagram\SDK\DTO\Direct\Inbox;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\Responses\Serializers\Traits\OnPropagateDecodeEventTrait;

/**
 * Class InboxMessage
 *
 * @package Instagram\SDK\DTO\Messages\Direct
 */
class InboxMessage extends Envelope
{

    use OnPropagateDecodeEventTrait;

    /**
     * The logged in user property.
     *
     * @var Inbox
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
