<?php

declare(strict_types=1);

namespace Instagram\SDK\Session;

use GuzzleHttp\Cookie\CookieJar;
use Instagram\SDK\Device\DeviceInterface;
use Instagram\SDK\Response\DTO\Session\User;

/**
 * Class Session
 *
 * @package Instagram\SDK\Session
 */
final class Session
{

    /** @var string The unique id */
    private $uuid;

    /** @var User */
    private $user;

    /** @var DeviceInterface */
    private $device;

    /** @var string Session id. */
    private $sessionId;

    /** @var CookieJar */
    private $cookies;

    /**
     * Session constructor.
     *
     * @param string          $uuid
     * @param User            $user
     * @param DeviceInterface $device
     * @param string          $sessionId
     * @param CookieJar       $cookies
     */
    public function __construct(string $uuid, User $user, DeviceInterface $device, string $sessionId, CookieJar $cookies)
    {
        $this->uuid = $uuid;
        $this->user = $user;
        $this->device = $device;
        $this->sessionId = $sessionId;
        $this->cookies = $cookies;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->sessionId;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return DeviceInterface
     */
    public function getDevice(): DeviceInterface
    {
        return $this->device;
    }

    /**
     * @return CookieJar
     */
    public function getCookies(): CookieJar
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

    /**
     * Returns the ranked token.
     *
     * @return string
     */
    public function getRankedToken(): string
    {
        return strtoupper(sprintf('%s_%s', $this->user->getId(), $this->getUuid()));
    }
}
