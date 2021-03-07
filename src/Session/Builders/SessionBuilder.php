<?php

declare(strict_types=1);

namespace Instagram\SDK\Session\Builders;

use GuzzleHttp\Cookie\CookieJar;
use Instagram\SDK\Device\DeviceInterface;
use Instagram\SDK\Response\DTO\Session\User;
use Instagram\SDK\Session\Session;

/**
 * Class SessionBuilder
 *
 * @package Instagram\SDK\Session\Builders
 */
final class SessionBuilder
{

    /** @var string */
    private $uuid;

    /** @var User */
    private $user;

    /** @var DeviceInterface */
    private $device;

    /** @var string */
    private $sessionId;

    /** @var CookieJar */
    private $cookies;

    /**
     * SessionBuilder constructor.
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
     * The session builder.
     *
     * @return Session
     */
    public function build(): Session
    {
        return new Session($this->uuid, $this->user, $this->device, $this->sessionId, $this->cookies);
    }
}
