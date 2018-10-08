<?php

namespace Instagram\SDK\Responses\Serializers\Interfaces;

use Instagram\SDK\DTO\Envelope;

/**
 * Interface OnDecodeInterface
 *
 * @package Instagram\SDK\Responses\Serializers\Interfaces
 */
interface OnDecodeInterface
{

    /**
     * On decode method.
     *
     * @param Envelope $message
     */
    public function onDecode(Envelope &$message): void;
}
