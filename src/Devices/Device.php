<?php

namespace NicklasW\Instagram\Devices;

use NicklasW\Instagram\Devices\Interfaces\DeviceInterface;
use NicklasW\Instagram\Devices\Traits\DeviceIdentifierMethodsTrait;

class Device implements DeviceInterface
{

    use DeviceIdentifierMethodsTrait;

    /**
     * @var string The device version
     */
    protected const DEVICE_VERSION = '10.3.2';

    /**
     * @var string The locale
     */
    protected const LOCALE = 'en_US';

    /**
     * @var string
     */
    protected $dpi;

    /**
     * @var string
     */
    protected $resolution;

    /**
     * @var string
     */
    protected $vendor;

    /**
     * @var string
     */
    protected $model;

    /**
     * @var string
     */
    protected $device;

    /**
     * @var string
     */
    protected $cpu;

    /**
     * @var string
     */
    protected $phoneId;

    /**
     * @var string
     */
    protected $deviceId;

    /**
     * @var string
     */
    private $version;

    /**
     * Device constructor.
     *
     * @param string $version
     * @param string $dpi
     * @param string $resolution
     * @param string $vendor
     * @param string $model
     * @param string $device
     * @param string $cpu
     * @param string $id
     * @param string $deviceId
     */
    public function __construct(
        string $version,
        string $dpi,
        string $resolution,
        string $vendor,
        string $model,
        string $device,
        string $cpu,
        string $id,
        string $deviceId
    ) {
        $this->version = $version;
        $this->dpi = $dpi;
        $this->resolution = $resolution;
        $this->vendor = $vendor;
        $this->model = $model;
        $this->device = $device;
        $this->cpu = $cpu;
        $this->phoneId = $id;
        $this->deviceId = $deviceId;
    }

    /**
     * Returns the version.
     *
     * @return string
     */
    public function version(): string
    {
        return $this->version;
    }

    /**
     * Returns the DPI.
     *
     * @return string
     */
    public function dpi(): string
    {
        return $this->dpi;
    }

    /**
     * Returns the resolution.
     *
     * @return string
     */
    public function resolution(): string
    {
        return $this->resolution;
    }

    /**
     * Returns the vendor.
     *
     * @return string
     */
    public function vendor(): string
    {
        return $this->vendor;
    }

    /**
     * Returns the model.
     *
     * @return string
     */
    public function model(): string
    {
        return $this->model;
    }

    /**
     * Returns the device.
     *
     * @return string
     */
    public function device(): string
    {
        return $this->device;
    }

    /**
     * Returns the CPU.
     *
     * @return string
     */
    public function cpu(): string
    {
        return $this->cpu;
    }

    /**
     * Returns the phone id.
     *
     * @return string
     */
    public function phoneId(): string
    {
        return $this->phoneId;
    }

    /**
     * Returns the device id.
     *
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
        return $this->compose($this, self::DEVICE_VERSION, self::LOCALE);
    }

}