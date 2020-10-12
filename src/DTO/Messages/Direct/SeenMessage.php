<?php

namespace Instagram\SDK\DTO\Messages\Direct;

use Instagram\SDK\DTO\Envelope;
use Tebru\Gson\Annotation\SerializedName;

/**
 * Class SeenMessage
 *
 * @package Instagram\SDK\DTO\Messages\Direct
 */
class SeenMessage extends Envelope
{

    /**
     * @var int
     */
    protected $unseenCount;

    /**
     * @var int
     * @SerializedName("unseen_count_ts")
     */
    protected $unseenCountTimestamp;

    /**
     * @return int
     */
    public function getUnseenCount(): int
    {
        return $this->unseenCount;
    }

    /**
     * @return int
     */
    public function getUnseenCountTimestamp(): int
    {
        return $this->unseenCountTimestamp;
    }
}
