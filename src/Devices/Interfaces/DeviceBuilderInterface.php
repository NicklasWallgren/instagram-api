<?php

namespace Instagram\SDK\Devices\Interfaces;

/**
 * Interface DeviceBuilderInterface
 *
 * @package Instagram\SDK\Devices\Interfaces
 */
interface DeviceBuilderInterface
{

    /**
     * Builds the device.
     *
     * @return DeviceInterface
     */
    public function build(): DeviceInterface;
}
