<?php

declare(strict_types=1);

namespace Instagram\SDK\Client\Features;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\DTO\Messages\User\LogoutMessage;
use Instagram\SDK\DTO\Messages\User\SessionMessage;
use Instagram\SDK\Requests\Http\Factories\PayloadSerializerFactory;
use Instagram\SDK\Requests\Utils\SignatureUtils;
use Instagram\SDK\Responses\Serializers\User\LoginSerializer;
use Instagram\SDK\Session\Builders\SessionBuilder;
use function GuzzleHttp\Promise\task;

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
     * Authenticates a user.
     *
     * @param string $username The username
     * @param string $password The password
     * @return PromiseInterface<SessionMessage>
     */
    public function login(string $username, string $password): PromiseInterface
    {
        $this->session = (new SessionBuilder())->build($this->builder, $this->client);

        // @phan-suppress-next-line PhanUndeclaredMethod
        return $this->headers()->then(function () use ($username, $password): PromiseInterface {
            // phpcs:ignore
            $request = $this->buildRequestWithSerializer('accounts/login/', new SessionMessage(), new LoginSerializer($this->session, $this->client));

            $body = [
                'username'            => $username,
                'password'            => $password,
                'login_attempt_count' => '0',
                'device_id'           => $this->session->getDevice()->deviceId(),
            ];

            $request->setPayload($body)
                ->setPayloadSerializerType(PayloadSerializerFactory::TYPE_SIGNED);

            return $this->call($request);
        });
    }

    /**
     * Authenticates a user using nonce.
     *
     * @param string $nonce
     * @return PromiseInterface<SessionMessage>
     */
    public function loginUsingNonce(string $nonce): PromiseInterface
    {
        return task(function () use ($nonce): PromiseInterface {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            $request = $this->buildRequest('accounts/one_tap_app_login/', new SessionMessage());

            $body = [
                'device_id'   => $this->session->getDevice()->deviceId(),
                'user_id'     => $this->session->getUser()->getId(),
                'login_nonce' => $nonce,
                'adid'        => SignatureUtils::uuid(),
            ];

            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $request->setPayload($body)
                ->setPayloadSerializerType(PayloadSerializerFactory::TYPE_SIGNED);

            return $this->call($request);
        });
    }

    /**
     * Logout the authenticated user.
     *
     * @return PromiseInterface<LogoutMessage>
     */
    public function logout(): PromiseInterface
    {
        return task(function (): PromiseInterface {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            $request = $this->buildRequest('accounts/logout/', new LogoutMessage())
                ->addPayloadParam('device_id', $this->session->getDevice()->deviceId())
                ->addPayloadParam('one_tap_app_login', true);

            return $this->call($request);
        });
    }
}
