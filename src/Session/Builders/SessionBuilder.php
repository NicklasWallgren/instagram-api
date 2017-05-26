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
     * @param string                 $username
     * @param string                 $password
     * @param DeviceBuilderInterface $deviceBuilder
     * @return Session
     */
    public function build(string $username, string $password, DeviceBuilderInterface $deviceBuilder): Session
    {
        // Build the device instance
        $device = $deviceBuilder->build();

        return (new Session())
            ->setUuid(SignatureSupport::uuid())
            ->setDevice($device);
    }

}