<?php

declare(strict_types=1);

namespace Instagram\SDK\Device;

/**
 * Class Device
 *
 * @package Instagram\SDK\Device
 */
final class Device implements DeviceInterface
{

    private const DEVICE_VERSION = '10.28.0';
    private const LANGUAGE = 'en-US';

    /** @var string */
    private $model;

    /** @var string */
    private $os;

    /** @var string */
    private $locale;

    /** @var string */
    private $scale;

    /** @var string */
    private $gamut;

    /** @var string */
    private $resolution;

    /** @var string */
    private $phoneId;

    /** @var string */
    private $deviceId;

    /**
     * Device constructor.
     *
     * @param string $model
     * @param string $os
     * @param string $locale
     * @param string $scale
     * @param string $gamut
     * @param string $resolution
     * @param string $phoneId
     * @param string $deviceId
     */
    public function __construct(
        string $model,
        string $os,
        string $locale,
        string $scale,
        string $gamut,
        string $resolution,
        string $phoneId,
        string $deviceId
    ) {
        $this->model = $model;
        $this->os = $os;
        $this->locale = $locale;
        $this->scale = $scale;
        $this->gamut = $gamut;
        $this->resolution = $resolution;
        $this->phoneId = $phoneId;
        $this->deviceId = $deviceId;
    }

    /**
     * @return string
     */
    public function model(): string
    {
        return $this->model;
    }

    /**
     * @return string
     */
    public function os(): string
    {
        return $this->os;
    }

    /**
     * @return string
     */
    public function locale(): string
    {
        return $this->locale;
    }

    /**
     * @return string
     */
    public function scale(): string
    {
        return $this->scale;
    }

    /**
     * @return string
     */
    public function gamut(): string
    {
        return $this->gamut;
    }

    /**
     * @return string
     */
    public function resolution(): string
    {
        return $this->resolution;
    }

    /**
     * @return string
     */
    public function phoneId(): string
    {
        return $this->phoneId;
    }

    /**
     * @return string
     */
    public function deviceId(): string
    {
        return $this->deviceId;
    }

    /**
     * Returns the device identifier.
     *
     * @return string
     */
    public function identifier(): string
    {
        return $this->compose($this, self::DEVICE_VERSION, self::LANGUAGE);
    }

    /**
     * Composes a device identifier.
     *
     * @param DeviceInterface $device             The device
     * @param string          $applicationVersion The application level
     * @param string          $language           The language
     * @return string
     */
    public function compose(DeviceInterface $device, string $applicationVersion, string $language): string
    {
        return sprintf(
            'Instagram %s (%s; %s; %s; %s; scale=%s; gamut=%s; %s) AppleWebKit/420+',
            $applicationVersion,
            $device->model(),
            $device->os(),
            $device->locale(),
            $language,
            $device->scale(),
            $device->gamut(),
            $device->resolution()
        );
    }
}
