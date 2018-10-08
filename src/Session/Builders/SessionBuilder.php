<?php

namespace Instagram\SDK\Session\Builders;

use Instagram\SDK\Devices\Interfaces\DeviceBuilderInterface;
use Instagram\SDK\Http\RequestClient;
use Instagram\SDK\Requests\Support\SignatureSupport;
use Instagram\SDK\Session\Session;

/**
 * Class SessionBuilder
 *
 * @package Instagram\SDK\Session\Builders
 */
class SessionBuilder
{

    /**
     * The session builder.
     *
     * @param DeviceBuilderInterface $deviceBuilder
     * @param RequestClient          $client
     * @return Session
     */
    public function build(DeviceBuilderInterface $deviceBuilder, RequestClient $client): Session
    {
        // Build the device instance
        $device = $deviceBuilder->build();

        return (new Session())
            ->setUuid(SignatureSupport::uuid())
            ->setDevice($device)
            ->setCookies($client->getCookies());
    }
}
