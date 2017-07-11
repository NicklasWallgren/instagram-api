<?php

namespace Instagram\SDK\Devices\Traits;

use Instagram\SDK\Devices\Interfaces\DeviceInterface;

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

        // Instagram 10.28.0 (iPad2,5; iPhone OS 8_3; sv_SE; en; scale=2.00; gamut=normal; 640x960) AppleWebKit/420+


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
