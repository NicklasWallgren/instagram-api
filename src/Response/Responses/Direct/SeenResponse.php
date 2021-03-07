<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Responses\Direct;

use Instagram\SDK\Response\Responses\ResponseEnvelope;
use Tebru\Gson\Annotation\SerializedName;

/**
 * Class SeenMessage
 *
 * @package Instagram\SDK\Response\Responses\Direct
 */
final class SeenResponse extends ResponseEnvelope
{

    /** @var int */
    private $unseenCount;

    /**
     * @var int
     * @SerializedName("unseen_count_ts")
     */
    private $unseenCountTimestamp;

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
