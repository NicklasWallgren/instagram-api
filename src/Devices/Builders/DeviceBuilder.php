<?php

namespace Instagram\SDK\Devices\Builders;

use Instagram\SDK\Devices\Device;
use Instagram\SDK\Devices\Interfaces\DeviceBuilderInterface;
use Instagram\SDK\Devices\Interfaces\DeviceInterface;
use Instagram\SDK\Requests\Support\SignatureSupport;

class DeviceBuilder implements DeviceBuilderInterface
{

    /**
     * @var array
     */
    protected const DEVICES = [
        ['24/7.0', '380dpi', '1080x1920', 'OnePlus', 'ONEPLUS A3010', 'OnePlus3T', 'qcom'],
    ];

    /**
     * Builds the device.
     *
     * @return DeviceInterface
     */
    public function build(): DeviceInterface
    {
        $metadata = static::DEVICES[rand(0, sizeof(static::DEVICES) - 1)];

        $this->addPhoneId($metadata);
        $this->addDeviceId($metadata);

        return (new Device(...$metadata));
    }

    /**
     * Add phone id.
     *
     * @param array $metadata
     */
    protected function addPhoneId(array &$metadata): void
    {
        $metadata[] = SignatureSupport::uuid();
    }

    /**
     * Adds device id.
     *
     * @param array $metadata
     */
    protected function addDeviceId(array &$metadata): void
    {
        $metadata[] = SignatureSupport::deviceId(md5('test'));
    }
}
