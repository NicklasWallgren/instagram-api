<?php

namespace NicklasW\Instagram\DTO\Messages;

use NicklasW\Instagram\DTO\Envelope;
use NicklasW\Instagram\Responses\Serializers\Interfaces\OnItemDecodeInterface;
use NicklasW\Instagram\Responses\Serializers\Traits\OnPropagateDecodeEventTrait;
use Traits\MappableTrait;

class ThreadMessage extends Envelope implements OnItemDecodeInterface
{

    use MappableTrait;
    use OnPropagateDecodeEventTrait;

    /**
     * The logged in user property.
     *
     * @var \NicklasW\Instagram\DTO\Inbox\Thread
     */
    protected $thread;

    /**
     * @return \NicklasW\Instagram\DTO\Inbox\Thread
     */
    public function getThread(): \NicklasW\Instagram\DTO\Inbox\Thread
    {
        return $this->thread;
    }

}