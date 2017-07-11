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
        ['iPhone6,1', 'iOS 11_0', 'en_GB', '2.00', 'normal', '640x1136'],
        ['iPhone6,2', 'iOS 11_0', 'en_GB', '2.00', 'normal', '640x1136'],
        ['iPhone8,1', 'iOS 11_0', 'en_GB', '2.00', 'normal', '1080x1920'],
        ['iPad4,5', 'iOS 11_0', 'en_GB', '2.00', 'normal', '2048x1536'],
        ['iPad4,6', 'iOS 11_0', 'en_GB', '2.00', 'normal', '2048x1536'],
        ['iPad4,7', 'iOS 11_0', 'en_GB', '2.00', 'normal', '2048x1536'],
        ['iPad5,2', 'iOS 11_0', 'en_GB', '2.00', 'normal', '2048x1536'],
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
