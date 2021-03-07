<?php

declare(strict_types=1);

namespace Instagram\SDK\Client\Features;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Exceptions\InstagramException;
use Instagram\SDK\Request\Http\Factories\PayloadSerializerFactory;
use Instagram\SDK\Request\Utils\SignatureUtils;
use Instagram\SDK\Response\Responses\User\AuthenticatedUserResponse;
use Instagram\SDK\Response\Responses\User\LogoutResponse;
use Instagram\SDK\Response\Responses\User\SessionResponse;
use Instagram\SDK\Response\Serializers\User\LoginResponseSerializer;

/**
 * Trait AccountFeaturesTrait
 *
 * @package            Instagram\SDK\Client\Features
 * @phan-file-suppress PhanUnreferencedUseNormal
 */
trait AccountFeaturesTrait
{

    use DefaultFeaturesTrait;

    /**
     * Authenticate a user by username and password.
     *
     * @param string $username The username
     * @param string $password The password
     * @return PromiseInterface<AuthenticatedUserResponse|InstagramException>
     */
    public function login(string $username, string $password): PromiseInterface
    {
        // @phan-suppress-next-line PhanUndeclaredMethod
        return $this->headers()->then(function () use ($username, $password): PromiseInterface {
            $request = $this->buildRequest('accounts/login/', new SessionResponse());

            $payload = [
                'username'            => $username,
                'password'            => $password,
                'login_attempt_count' => '0',
                'device_id'           => $this->device->deviceId(),
            ];

            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $request->setPayload($payload, PayloadSerializerFactory::TYPE_SIGNED)
                ->setResponseSerializer(new LoginResponseSerializer($this->device, $this->client));

            return $this->call($request);
        });
    }

    /**
     * Authenticate a user by nonce.
     *
     * @param string $nonce
     * @return PromiseInterface<SessionResponse>
     */
    public function loginUsingNonce(string $nonce): PromiseInterface
    {
        return $this->authenticated(function () use ($nonce): PromiseInterface {
            $request = $this->buildRequest('accounts/one_tap_app_login/', new SessionResponse());

            $payload = [
                'device_id'   => $this->session->getDevice()->deviceId(),
                'user_id'     => $this->session->getUser()->getId(),
                'login_nonce' => $nonce,
                'adid'        => SignatureUtils::uuid(),
            ];

            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $request->setPayload($payload, PayloadSerializerFactory::TYPE_SIGNED)
                ->setResponseSerializer(new LoginResponseSerializer($this->device, $this->client));

            return $this->call($request);
        });
    }

    /**
     * Logout the authenticated user.
     *
     * @return PromiseInterface<LogoutResponse|InstagramException>
     */
    public function logout(): PromiseInterface
    {
        return $this->authenticated(function (): PromiseInterface {
            $request = $this->buildRequest('accounts/logout/', new LogoutResponse())
                ->addPayloadParam('device_id', $this->session->getDevice()->deviceId())
                ->addPayloadParam('one_tap_app_login', true);

            return $this->call($request);
        });
    }
}
