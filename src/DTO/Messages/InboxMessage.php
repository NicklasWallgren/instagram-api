<?php

namespace NicklasW\Instagram\DTO\Messages;

use NicklasW\Instagram\DTO\Envelope;
use NicklasW\Instagram\Responses\Serializers\Traits\OnPropagateDecodeEventTrait;
use Traits\MappableTrait;

class InboxMessage extends Envelope
{

    use MappableTrait;
    use OnPropagateDecodeEventTrait;

    /**
     * The logged in user property.
     *
     * @var \NicklasW\Instagram\DTO\Inbox\Inbox
     */
    protected $inbox;

    /**
     * @var int
     * @name seq_id
     */
    protected $seqId;

//    /**
//     * @var
//     */
//    protected $subscription;

    /**
     * @var int
     * @name pending_requests_total
     */
    protected $pendingRequestsTotal;

//    /**
//     * @var
//     * @name pending_requests_user
//     */
//    protected $pending_requests_users;

    /**
     * @return \NicklasW\Instagram\DTO\Inbox\Inbox
     */
    public function getInbox(): \NicklasW\Instagram\DTO\Inbox\Inbox
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