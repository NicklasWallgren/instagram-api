<?php

declare(strict_types=1);

namespace Instagram\SDK\Traits;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Client\Client;
use Instagram\SDK\Exceptions\InstagramException;
use Instagram\SDK\Response\Responses\User\AuthenticatedUserResponse;
use Instagram\SDK\Response\Responses\User\LogoutResponse;
use Instagram\SDK\Response\Responses\User\SessionResponse;
use Instagram\SDK\Utils\PromiseUtils;

/**
 * Trait MakeAccountRequestAccessible
 *
 * @package Instagram\SDK\Traits
 */
trait MakeAccountRequestAccessible
{

    /**
     * Authenticate a user using the provided username and password.
     *
     * @param string $username
     * @param string $password
     * @return AuthenticatedUserResponse
     * @throws InstagramException in case of an error
     */
    public function login(string $username, string $password): AuthenticatedUserResponse
    {
        return PromiseUtils::wait($this->loginPromise($username, $password));
    }

    /**
     * Authenticates a user using the provided username and password.
     *
     * @param string $username
     * @param string $password
     * @return PromiseInterface<SessionResponse|InstagramException>
     */
    public function loginPromise(string $username, string $password): PromiseInterface
    {
        return $this->getClient()->login($username, $password);
    }


    /**
     * Authenticates a user using nonce.
     *
     * @param string $nonce
     * @return SessionResponse
     * @throws InstagramException in case of an error
     */
    public function loginUsingNonce(string $nonce): SessionResponse
    {
        return PromiseUtils::wait($this->loginUsingNoncePromise($nonce));
    }

    /**
     * Authenticates a user using nonce.
     *
     * @param string $nonce
     * @return PromiseInterface<SessionResponse|InstagramException>
     */
    public function loginUsingNoncePromise(string $nonce): PromiseInterface
    {
        return $this->getClient()->loginUsingNonce($nonce);
    }

    /**
     * Logout the authenticated user.
     *
     * @return LogoutResponse
     * @throws InstagramException in case of an error
     */
    public function logout(): LogoutResponse
    {
        return PromiseUtils::wait($this->logoutPromise());
    }

    /**
     * Logout the authenticated user.
     *
     * @return PromiseInterface<LogoutResponse|InstagramException>
     */
    public function logoutPromise(): PromiseInterface
    {
        return $this->getClient()->logout();
    }

    /**
     * Returns the client.
     *
     * @return Client
     */
    abstract protected function getClient(): Client;
}
