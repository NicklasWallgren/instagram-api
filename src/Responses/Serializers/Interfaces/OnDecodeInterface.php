<?php

namespace Instagram\SDK\Responses\Serializers\Interfaces;

/**
 * Interface OnDecodeInterface
 *
 * @package Instagram\SDK\Responses\Serializers\Interfaces
 */
interface OnDecodeInterface
{

    /**
     * On item decode method.
     *
     * @param array<string, mixed> $container
     */
    public function onDecode(array $container): void;
}
