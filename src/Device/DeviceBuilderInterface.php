<?php

declare(strict_types=1);

namespace Instagram\SDK\Device;

/**
 * Interface DeviceBuilderInterface
 *
 * @package Instagram\SDK\Device
 */
interface DeviceBuilderInterface
{

    /**
     * Builds a {@link DeviceInterface} instance.
     *
     * @return DeviceInterface
     */
    public function build(): DeviceInterface;
}
