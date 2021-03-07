<?php

declare(strict_types=1);

namespace Instagram\SDK\Device\Builders;

use Instagram\SDK\Device\Device;
use Instagram\SDK\Device\DeviceBuilderInterface;
use Instagram\SDK\Device\DeviceInterface;
use Instagram\SDK\Request\Utils\SignatureUtils;

/**
 * Class DeviceBuilder
 *
 * @package Instagram\SDK\Device\Builders
 */
final class DeviceBuilder implements DeviceBuilderInterface
{

    /** @var array<array<string>> */
    private const DEVICES = [
        ['iPhone6,1', 'iOS 11_0', 'en_GB', '2.00', 'normal', '640x1136'],
        ['iPhone6,2', 'iOS 11_0', 'en_GB', '2.00', 'normal', '640x1136'],
        ['iPhone8,1', 'iOS 11_0', 'en_GB', '2.00', 'normal', '1080x1920'],
        ['iPad4,5', 'iOS 11_0', 'en_GB', '2.00', 'normal', '2048x1536'],
        ['iPad4,6', 'iOS 11_0', 'en_GB', '2.00', 'normal', '2048x1536'],
        ['iPad4,7', 'iOS 11_0', 'en_GB', '2.00', 'normal', '2048x1536'],
        ['iPad5,2', 'iOS 11_0', 'en_GB', '2.00', 'normal', '2048x1536'],
    ];

    /**
     * @return DeviceBuilder
     */
    public static function builder(): DeviceBuilder
    {
        return new DeviceBuilder();
    }

    /**
     * Builds the device.
     *
     * @return DeviceInterface
     */
    public function build(): DeviceInterface
    {
        $metadata = DeviceBuilder::DEVICES[rand(0, sizeof(DeviceBuilder::DEVICES) - 1)];

        // Compose a unique device id
        $uniqueDeviceId = $this->getUniqueSignatureId();

        $this->addPhoneId($metadata, $uniqueDeviceId);
        $this->addDeviceId($metadata, $uniqueDeviceId);

        // @phan-suppress-next-line PhanPossiblyNullTypeArgument
        return new Device(...$metadata);
    }

    /**
     * Add phone id.
     *
     * @param array<int, mixed> $metadata
     * @param string            $id
     */
    private function addPhoneId(array &$metadata, string $id): void
    {
        $metadata[] = $id;
    }

    /**
     * Adds device id.
     *
     * @param array<int, mixed> $metadata
     * @param string            $id
     */
    private function addDeviceId(array &$metadata, string $id): void
    {
        $metadata[] = $id;
    }

    /**
     * Returns a unique signature id.
     *
     * @return string
     */
    private function getUniqueSignatureId(): string
    {
        return strtoupper(SignatureUtils::uuid());
    }
}
