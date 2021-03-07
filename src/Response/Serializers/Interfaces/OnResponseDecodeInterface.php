<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Serializers\Interfaces;

use Instagram\SDK\Response\DTO\Adapters\OnDecodeContext;

/**
 * Interface OnResponseDecodeInterface
 *
 * @package Instagram\SDK\Response\Serializers\Interfaces
 */
interface OnResponseDecodeInterface
{

    /**
     * On item decode method.
     *
     * @param OnDecodeContext $context
     */
    public function onDecode(OnDecodeContext $context): void;
}
