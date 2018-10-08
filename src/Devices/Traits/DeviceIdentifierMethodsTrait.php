<?php

namespace Instagram\SDK\Devices\Traits;

use Instagram\SDK\Devices\Interfaces\DeviceInterface;

/**
 * Trait DeviceIdentifierMethodsTrait
 *
 * @package Instagram\SDK\Devices\Traits
 */
trait DeviceIdentifierMethodsTrait
{

    /**
     * Composes a device identifier.
     *
     * @param DeviceInterface $device             The device
     * @param string          $applicationVersion The application level
     * @param string          $language           The language
     * @return string
     */
    public function compose(DeviceInterface $device, string $applicationVersion, string $language): string
    {
        return sprintf(
            'Instagram %s (%s; %s; %s; %s; scale=%s; gamut=%s; %s) AppleWebKit/420+',
            $applicationVersion,
            $device->model(),
            $device->os(),
            $device->locale(),
            $language,
            $device->scale(),
            $device->gamut(),
            $device->resolution()
        );
    }
}
