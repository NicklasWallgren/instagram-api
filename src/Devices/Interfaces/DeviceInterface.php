<?php

namespace NicklasW\Instagram\Devices\Interfaces;

interface DeviceInterface
{

    /**
     * Returns the DPI.
     *
     * @return string
     */
    public function dpi(): string;

    /**
     * Returns the resolution.
     *
     * @return string
     */
    public function resolution(): string;

    /**
     * Returns the vendor.
     *
     * @return string
     */
    public function vendor(): string;

    /**
     * Returns the model.
     *
     * @return string
     */
    public function model(): string;

    /**
     * Returns the device.
     *
     * @return string
     */
    public function device(): string;

    /**
     * Returns the CPU.
     *
     * @return string
     */
    public function cpu(): string;

    /**
     * Returns the phone id.
     *
     * @return string
     */
    public function phoneId(): string;

    /**
     * Returns the device id.
     *
     * @return string
     */
    public function deviceId(): string;

    /**
     * Returns the device identifier.
     *
     * @return string
     */
    public function identifier(): string;

}