<?php

namespace Instagram\SDK\Session\Builders;

use Instagram\SDK\Devices\Interfaces\DeviceBuilderInterface;
use Instagram\SDK\DTO\CsrfTokenMessage;
use Instagram\SDK\Requests\Support\SignatureSupport;
use Instagram\SDK\Session\Session;

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
