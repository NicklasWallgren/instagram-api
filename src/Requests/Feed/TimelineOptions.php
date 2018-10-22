<?php

namespace Instagram\SDK\Requests\Feed;

use Instagram\SDK\Requests\Options\AbstractOptions;

/**
 * Class TimelineOptions
 *
 * @package Instagram\SDK\Requests\Feed
 */
class TimelineOptions extends AbstractOptions
{

    /**
     * @var string
     */
    protected $reason;

    /**
     * @var bool
     */
    protected $isPrefetch;

    /**
     * @var bool
     */
    protected $isCharging;

    /**
     * @var int
     */
    protected $timezoneOffset;

    /**
     * @var int
     */
    protected $batteryLevel;

    /**
     * TimelineOptions constructor.
     *
     * @param string $reason
     * @param bool   $isPrefetch
     * @param bool   $isCharging
     * @param int    $timezoneOffset
     * @param int    $batteryLevel
     */
    public function __construct(
        string $reason = 'cold_start_fetch',
        bool $isPrefetch = false,
        bool $isCharging = false,
        int $timezoneOffset = 7200,
        int $batteryLevel = 80
    ) {
        $this->reason = $reason;
        $this->isPrefetch = $isPrefetch;
        $this->isCharging = $isCharging;
        $this->timezoneOffset = $timezoneOffset;
        $this->batteryLevel = $batteryLevel;
    }
}
