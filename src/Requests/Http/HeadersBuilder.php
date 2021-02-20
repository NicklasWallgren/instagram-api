<?php

namespace Instagram\SDK\Requests\Http;

/**
 * Class HeadersBuilder
 *
 * @package Instagram\SDK\Requests\Http
 */
final class HeadersBuilder
{

    private const USER_AGENT = 'User-Agent';
    private const CAPABILITIES = 'X-IG-Capabilities';
    private const CONNECTION_TYPE = 'X-IG-Connection-Type';
    private const CONNECTION_SPEED = 'X-IG-Connection-Speed';
    private const HTTP_ENGINE = 'X-FB-HTTP-Engine';

    /**
     * Returns the default headers.
     *
     * @return array<string, mixed>
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
