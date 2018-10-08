<?php

namespace Instagram\SDK\Responses\Serializers\Interfaces;

/**
 * Interface OnItemDecodeInterface
 *
 * @package Instagram\SDK\Responses\Serializers\Interfaces
 */
interface OnItemDecodeInterface
{

    /**
     * On item decode method.
     *
     * @param array $container
     * @param array $requirements
     */
    public function onDecode(array $container, $requirements = []): void;
}
