<?php

namespace Instagram\SDK\Session\Builders;

use Instagram\SDK\Devices\Interfaces\DeviceBuilderInterface;
use Instagram\SDK\Http\HttpClient;
use Instagram\SDK\Requests\Utils\SignatureUtils;
use Instagram\SDK\Session\Session;

/**
 * Class SessionBuilder
 *
 * @package Instagram\SDK\Session\Builders
 */
final class SessionBuilder
{

    /**
     * The session builder.
     *
     * @param DeviceBuilderInterface $deviceBuilder
     * @param HttpClient             $client
     * @return Session
     */
    public function build(DeviceBuilderInterface $deviceBuilder, HttpClient $client): Session
    {
        // Build the device instance
        $device = $deviceBuilder->build();

        return (new Session())
            ->setUuid(SignatureUtils::uuid())
            ->setDevice($device)
            ->setSessionId(SignatureUtils::uuid())
            ->setCookies($client->getCookies());
    }
}
