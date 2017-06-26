<?php

namespace NicklasW\Instagram\Session;

use GuzzleHttp\Cookie\CookieJar;
use NicklasW\Instagram\Devices\Interfaces\DeviceInterface;
use NicklasW\Instagram\DTO\CsrfToken;
use NicklasW\Instagram\DTO\Session\SessionId;
use NicklasW\Instagram\DTO\Session\User;

class Session
{

    /**
     * @var SessionId
     */
    protected $id;

    /**
     * @var string The unique id
     */
    protected $uuid;

    /**
     * @var CsrfToken The csrf token
     */
    protected $csrfToken;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var DeviceInterface
     */
    protected $device;

    /**
     * @var CookieJar
     */
    protected $cookies;

    /**
     * @return SessionId
     */
    public function getId(): SessionId
    {
        return $this->id;
    }

    /**
     * @param SessionId $id
     */
    public function setId(SessionId $id)
    {
        $this->id = $id;
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
     * @return $this
     */
    public function setUuid(string $uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * @return CsrfToken
     */
    public function getCsrfToken(): CsrfToken
    {
        return $this->csrfToken;
    }

    /**
     * @param CsrfToken $csrfToken
     * @return $this
     */
    public function setCsrfToken(CsrfToken $csrfToken)
    {
        $this->csrfToken = $csrfToken;

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
     */
    public function setUser(User $user)
    {
        $this->user = $user;
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
     * @return $this
     */
    public function setDevice(DeviceInterface $device)
    {
        $this->device = $device;

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
     */
    public function setCookies(CookieJar $cookies)
    {
        $this->cookies = $cookies;
    }
}
