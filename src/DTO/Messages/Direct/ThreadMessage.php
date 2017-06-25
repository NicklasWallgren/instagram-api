<?php

namespace NicklasW\Instagram\DTO\Messages\Direct;

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
     * @var \NicklasW\Instagram\DTO\Direct\Thread
     */
    protected $thread;

    /**
     * @return \NicklasW\Instagram\DTO\Direct\Thread
     */
    public function getThread(): \NicklasW\Instagram\DTO\Direct\Thread
    {
        return $this->thread;
    }

}