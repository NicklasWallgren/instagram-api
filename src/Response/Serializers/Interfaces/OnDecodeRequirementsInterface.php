<?php

declare(strict_types=1);

namespace Instagram\SDK\Responses\Serializers\Interfaces;

/**
 * Interface OnDecodeRequirementsInterface
 *
 * @package Instagram\SDK\Response\Serializers\Interfaces
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
