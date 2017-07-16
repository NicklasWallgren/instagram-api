<?php

namespace Instagram\SDK\Requests\Http;

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
     * @var string The connection speed
     */
    protected const CONNECTION_SPEED = 'X-IG-Connection-Speed';

    /**
     * @var string The http engine
     */
    protected const HTTP_ENGINE = 'X-FB-HTTP-Engine';

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
            self::USER_AGENT       => $device->identifier(),
            self::CAPABILITIES     => '36oD',
            self::CONNECTION_TYPE  => 'WIFI',
            self::CONNECTION_SPEED => $this->getConnectionSpeed(),
            'Connection'           => 'keep-alive',
            'Content-Type'         => 'application/x-www-form-urlencoded; charset=UTF-8',
            'Accept-Language'      => 'en;q=1',
            'Accept-Encoding'      => 'gzip, deflate',
            'Accept'               => '*/*',
        ], []);
    }

    /**
     * Returns the connection speed.
     *
     * @return string
     */
    protected function getConnectionSpeed(): string
    {
        return rand(1000, 3700) . 'kbps';
    }
}
