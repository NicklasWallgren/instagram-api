<?php

namespace Instagram\SDK\DTO\Messages\Direct;

use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\Responses\Serializers\Interfaces\OnItemDecodeInterface;
use Instagram\SDK\Responses\Serializers\Traits\OnPropagateDecodeEventTrait;
use Traits\MappableTrait;

/**
 * Class ThreadMessage
 *
 * @package Instagram\SDK\DTO\Messages\Direct
 */
class ThreadMessage extends Envelope implements OnItemDecodeInterface
{

    use MappableTrait;
    use OnPropagateDecodeEventTrait;

    /**
     * The logged in user property.
     *
     * @var \Instagram\SDK\DTO\Direct\Thread
     */
    protected $thread;

    /**
     * @return \Instagram\SDK\DTO\Direct\Thread
     */
    public function getThread(): \Instagram\SDK\DTO\Direct\Thread
    {
        return $this->thread;
    }
}
