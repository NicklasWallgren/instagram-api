<?php

namespace NicklasW\Instagram\Requests\Http;

class HeadersBuilder
{

    /**
     * @var string The user agent header
     */
    protected const USER_AGENT = 'User-Agent';

    /**
     * @var string The capabilities header
     */
    protected const CAPABILITIES = 'X-IG-Capabilities';

    /**
     * @var string The connection type header
     */
    protected const CONNECTION_TYPE = 'X-IG-Connection-Type';

    /**
     * Returns the default headers.
     *
     * @return array
     */
    public function build(): array
    {
        list($session) = func_get_args();

        // Retrieve the session device
        $device = $session->getDevice();

        return array_merge([
            self::USER_AGENT      => $device->identifier(),
            self::CAPABILITIES    => '3ToAAA==',
            self::CONNECTION_TYPE => 'WIFI',
            'Content-Type'        => 'application/x-www-form-urlencoded; charset=UTF-8',
            'Accept-Language'     => 'en-US',
        ], []);
    }

}