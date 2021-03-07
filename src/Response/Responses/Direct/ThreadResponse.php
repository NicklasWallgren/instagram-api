<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Responses\Direct;

use Instagram\SDK\Response\DTO\Direct\Thread;
use Instagram\SDK\Response\Responses\ResponseEnvelope;
use Tebru\Gson\Annotation\JsonAdapter;

/**
 * Class ThreadMessage
 *
 * @package Instagram\SDK\Response\Responses\Direct
 */
final class ThreadResponse extends ResponseEnvelope
{

    /**
     * @var Thread
     * @JsonAdapter("Instagram\SDK\Response\DTO\Direct\Adapters\ThreadAdapterFactory")
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
