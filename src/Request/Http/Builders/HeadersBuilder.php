<?php

declare(strict_types=1);

namespace Instagram\SDK\Request\Http\Builders;

use Instagram\SDK\Device\DeviceInterface;
use InvalidArgumentException;
use Webmozart\Assert\Assert;

/**
 * Class HeadersBuilder
 *
 * @package Instagram\SDK\Request\Http\Builders
 */
final class HeadersBuilder
{

    private const USER_AGENT = 'User-Agent';
    private const CAPABILITIES = 'X-IG-Capabilities';
    private const CONNECTION_TYPE = 'X-IG-Connection-Type';
    private const CONNECTION_SPEED = 'X-IG-Connection-Speed';

    /** @var DeviceInterface */
    private $device;

    public static function builder(): HeadersBuilder
    {
        return new HeadersBuilder();
    }

    /**
     * @param DeviceInterface $device
     * @return static
     */
    public function setDevice(DeviceInterface $device): HeadersBuilder
    {
        $this->device = $device;
        return $this;
    }

    /**
     * Returns the default headers.
     *
     * @return array<string, mixed>
     * @throws InvalidArgumentException
     */
    public function build(): array
    {
        Assert::notNull($this->device);

        return array_merge([
            self::USER_AGENT       => $this->device->identifier(),
            self::CAPABILITIES     => '36oD',
            self::CONNECTION_TYPE  => 'WIFI',
            self::CONNECTION_SPEED => self::getConnectionSpeed(),
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
    private static function getConnectionSpeed(): string
    {
        return rand(1000, 3700) . 'kbps';
    }
}
