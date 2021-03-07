<?php

declare(strict_types=1);

namespace Instagram\SDK\Request\Payload;

/**
 * Interface RequestPayloadInterface
 *
 * @package Instagram\SDK\Request\Payloads
 */
interface RequestPayloadInterface
{
    /**
     * Returns the payload.
     *
     * @return array<string, mixed>
     */
    public function payload(): array;
}
