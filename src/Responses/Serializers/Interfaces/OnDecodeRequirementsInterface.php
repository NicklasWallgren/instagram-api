<?php

namespace Instagram\SDK\Responses\Serializers\Interfaces;

/**
 * Interface OnDecodeRequirementsInterface
 *
 * @package Instagram\SDK\Responses\Serializers\Interfaces
 */
interface OnDecodeRequirementsInterface
{

    /**
     * Returns the requirements.
     *
     * @return string[]
     */
    public function requirements(): array;
}
