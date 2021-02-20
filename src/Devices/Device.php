<?php

namespace Instagram\SDK\Devices;

use Instagram\SDK\Devices\Interfaces\DeviceInterface;
use Instagram\SDK\Devices\Traits\DeviceIdentifierMethodsTrait;

/**
 * Class Device
 *
 * @package Instagram\SDK\Devices
 */
final class Device implements DeviceInterface
{

    use DeviceIdentifierMethodsTrait;

    private const DEVICE_VERSION = '10.28.0';
    private const LANGUAGE = 'en-US';

    /**
     * @var string
     */
    private $model;

    /**
     * @var string
     */
    private $os;

    /**
     * @var string
     */
    private $locale;

    /**
     * @var string
     */
    private $scale;

    /**
     * @var string
     */
    private $gamut;

    /**
     * @var string
     */
    private $resolution;

    /**
     * @var string
     */
    private $phoneId;

    /**
     * @var string
     */
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
}
