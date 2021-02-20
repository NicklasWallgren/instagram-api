<?php

namespace Instagram\SDK\DTO\Messages\Direct;

use Instagram\SDK\DTO\Direct\Thread;
use Instagram\SDK\DTO\Envelope;
use Tebru\Gson\Annotation\JsonAdapter;

/**
 * Class ThreadMessage
 *
 * @package Instagram\SDK\DTO\Messages\Direct
 */
final class ThreadMessage extends Envelope
{

    /**
     * The logged in user property.
     *
     * @var Thread
     * @JsonAdapter("Instagram\SDK\DTO\Direct\Adapters\ThreadAdapterFactory")
     */
    private $thread;

    /**
     * @return Thread
     */
    public function getThread(): Thread
    {
        return $this->thread;
    }
}
