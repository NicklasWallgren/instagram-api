<?php

namespace Instagram\SDK\DTO\Messages\Direct;

use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\Responses\Serializers\Traits\OnPropagateDecodeEventTrait;
use Traits\MappableTrait;

/**
 * Class InboxMessage
 *
 * @package Instagram\SDK\DTO\Messages\Direct
 */
class InboxMessage extends Envelope
{

    use MappableTrait;
    use OnPropagateDecodeEventTrait;

    /**
     * The logged in user property.
     *
     * @var \Instagram\SDK\DTO\Direct\Inbox
     */
    protected $inbox;

    /**
     * @var int
     * @name seq_id
     */
    protected $seqId;

    /**
     * @var mixed
     */
    protected $subscription;

    /**
     * @var int
     * @name pending_requests_total
     */
    protected $pendingRequestsTotal;

    /**
     * @var mixed
     * @name pending_requests_user
     */
    protected $pendingRequestsUsers;

    /**
     * @return \Instagram\SDK\DTO\Direct\Inbox
     */
    public function getInbox(): \Instagram\SDK\DTO\Direct\Inbox
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
