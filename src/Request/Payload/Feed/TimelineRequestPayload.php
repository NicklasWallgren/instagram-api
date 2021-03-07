<?php

declare(strict_types=1);

namespace Instagram\SDK\Request\Payload\Feed;

use Instagram\SDK\Request\Payload\RequestPayloadInterface;

/**
 * Class TimelineRequestPayload
 *
 * @package Instagram\SDK\Request\Payload\Feed
 */
final class TimelineRequestPayload implements RequestPayloadInterface
{

    /** @var string */
    private $reason;

    /** @var bool */
    private $isPrefetch;

    /** @var bool */
    private $isCharging;

    /** @var int */
    private $timezoneOffset;

    /** @var int */
    private $batteryLevel;

    /**
     * TimelinePayload constructor.
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

    /**
     * @inheritDoc
     */
    public function payload(): array
    {
        $result = [];

        foreach (get_object_vars($this) as $parameter => $value) {
            $result[self::underscore($parameter)] = $value;
        }

        return $result;
    }

    /**
     * Returns the camel cased string as underscore case.
     *
     * @param string $target
     * @return string
     */
    private static function underscore(string $target): string
    {
        return strtolower(preg_replace('/(?<=\\w)([A-Z])/', '_\\1', $target));
    }
}
