<?php

namespace Instagram\SDK\Devices;

use Instagram\SDK\Devices\Interfaces\DeviceInterface;
use Instagram\SDK\Devices\Traits\DeviceIdentifierMethodsTrait;

class Device implements DeviceInterface
{

    use DeviceIdentifierMethodsTrait;

    /**
     * @var string The device version
     */
    protected const DEVICE_VERSION = '10.28.0';

    /**
     * @var string The language
     */
    protected const LANGUAGE = 'en-US';

    /**
     * @var string
     */
    protected $model;

    /**
     * @var string
     */
    protected $os;

    /**
     * @var string
     */
    protected $locale;

    /**
     * @var string
     */
    protected $scale;

    /**
     * @var string
     */
    protected $gamut;

    /**
     * @var string
     */
    protected $resolution;

    /**
     * @var string
     */
    protected $phoneId;

    /**
     * @var string
     */
    protected $deviceId;

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
        $model,
        $os,
        $locale,
        $scale,
        $gamut,
        $resolution,
        $phoneId,
        $deviceId
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
