<?php

namespace NicklasW\Instagram\Session\Builders;

use NicklasW\Instagram\Devices\Interfaces\DeviceBuilderInterface;
use NicklasW\Instagram\DTO\CsrfTokenMessage;
use NicklasW\Instagram\Requests\Support\SignatureSupport;
use NicklasW\Instagram\Session\Session;

class SessionBuilder
{

    /**
     * The session builder.
     *
     * @param DeviceBuilderInterface $deviceBuilder
     * @return Session
     */
    public function build(DeviceBuilderInterface $deviceBuilder): Session
    {
        // Build the device instance
        $device = $deviceBuilder->build();

        return (new Session())
            ->setUuid(SignatureSupport::uuid())
            ->setDevice($device);
    }
}
