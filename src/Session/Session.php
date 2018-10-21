<?php

namespace Instagram\SDK\Session;

use GuzzleHttp\Cookie\CookieJar;
use Instagram\SDK\Devices\Interfaces\DeviceInterface;
use Instagram\SDK\DTO\Session\User;
use Instagram\SDK\Http\Traits\CookieMethodsTrait;

/**
 * Class Session
 *
 * @package Instagram\SDK\Session
 */
class Session
{

    use CookieMethodsTrait {
        getSessionId as protected _getSessionId;
    }
    use SessionMethodsTrait;

    /**
     * @var string The unique id
     */
    protected $uuid;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var DeviceInterface
     */
    protected $device;

    /**
     * @var string Session id.
     */
    protected $sessionId;

    /**
     * @var CookieJar
     */
    protected $cookies;

    /**
     * @return string
     * @throws \Exception
     */
    public function getId(): string
    {
        return $this->_getSessionId()->getId();
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     * @return static
     */
    public function setUuid(string $uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return static
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return DeviceInterface
     */
    public function getDevice(): DeviceInterface
    {
        return $this->device;
    }

    /**
     * @param DeviceInterface $device
     * @return static
     */
    public function setDevice(DeviceInterface $device)
    {
        $this->device = $device;

        return $this;
    }

    /**
     * @return string
     */
    public function getSessionId(): string
    {
        return $this->sessionId;
    }

    /**
     * @param string $sessionId
     * @return static
     */
    public function setSessionId(string $sessionId): self
    {
        $this->sessionId = $sessionId;

        return $this;
    }

    /**
     * @return CookieJar
     */
    public function getCookies(): CookieJar
    {
        return $this->cookies;
    }

    /**
     * @param CookieJar $cookies
     * @return static
     */
    public function setCookies(CookieJar $cookies)
    {
        $this->cookies = $cookies;

        return $this;
    }

    /**
     * Returns the cookie jar.
     *
     * @return CookieJar
     */
    protected function getCookieJar(): CookieJar
    {
        return $this->cookies;
    }

    /**
     * @return Session
     */
    public function getSession(): Session
    {
        return $this;
    }
}
