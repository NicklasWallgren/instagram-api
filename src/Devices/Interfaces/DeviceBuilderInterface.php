<?php

namespace NicklasW\Instagram\Devices\Interfaces;

interface DeviceBuilderInterface
{

    /**
     * Builds the device.
     *
     * @return DeviceInterface
     */
    public function build(): DeviceInterface;
}
