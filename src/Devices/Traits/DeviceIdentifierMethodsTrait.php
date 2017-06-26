<?php

namespace NicklasW\Instagram\Devices\Traits;

use NicklasW\Instagram\Devices\Interfaces\DeviceInterface;

trait DeviceIdentifierMethodsTrait
{

    /**
     * Composes a device identifier.
     *
     * @param DeviceInterface $device             The device
     * @param string          $applicationVersion The application level
     * @param string          $locale             The locale
     * @return string
     */
    public function compose(DeviceInterface $device, string $applicationVersion, string $locale): string
    {
        return sprintf(
            'Instagram %s Android (%s; %s; %s; %s; %s; %s; %s; %s)',
            $applicationVersion,
            $device->version(),
            $device->dpi(),
            $device->resolution(),
            $device->vendor(),
            $device->model(),
            $device->device(),
            $device->cpu(),
            $locale
        );
    }
}
