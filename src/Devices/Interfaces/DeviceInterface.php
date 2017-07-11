<?php

namespace Instagram\SDK\Devices\Interfaces;

interface DeviceInterface
{

    /**
     * Returns the model.
     *
     * @return string
     */
    public function model(): string;

    /**
     * Returns the os.
     *
     * @return string
     */
    public function os(): string;

    /**
     * Returns the locale.
     *
     * @return string
     */
    public function locale(): string;

    /**
     * Returns the scale.
     *
     * @return string
     */
    public function scale(): string;

    /**
     * Returns the gamut.
     *
     * @return string
     */
    public function gamut(): string;

    /**
     * Returns the resolution.
     *
     * @return string
     */
    public function resolution(): string;

    /**
     * Returns the device identifier.
     *
     * @return string
     */
    public function identifier(): string;

    /**
     * Returns the phone id.
     *
     * @return string
     */
    public function phoneId(): string;

    /**
     * Returns device id.
     *
     * @return string
     */
    public function deviceId(): string;

}
