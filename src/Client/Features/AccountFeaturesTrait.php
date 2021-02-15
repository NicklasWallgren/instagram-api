<?php

declare(strict_types=1);

namespace Instagram\SDK\Client\Features;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\DTO\Messages\User\LogoutMessage;
use Instagram\SDK\DTO\Messages\User\SessionMessage;
use Instagram\SDK\Requests\GenericRequest;
use Instagram\SDK\Requests\Http\Factories\SerializerFactory;
use Instagram\SDK\Requests\Support\SignatureSupport;
use Instagram\SDK\Requests\User\LoginRequest;
use Instagram\SDK\Session\Builders\SessionBuilder;
use function Instagram\SDK\Support\Promises\task;

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
        // Initialize a new session
        $this->session = (new SessionBuilder())->build($this->builder, $this->client);

        // @phan-suppress-next-line PhanUndeclaredMethod
        return $this->headers()->then(function () use ($username, $password): PromiseInterface {
            return (new LoginRequest($username, $password, $this->session, $this->client))->fire();
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

            /** @var GenericRequest $request */
            $request = $this->request('accounts/one_tap_app_login/', new SessionMessage());

            $body = [
                'device_id'   => $this->session->getDevice()->deviceId(),
                'user_id'     => $this->session->getUser()->getId(),
                'login_nonce' => $nonce,
                'adid'        => SignatureSupport::uuid(),
            ];

            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $request->setPayload($body)
                ->setSerializerType(SerializerFactory::TYPE_SIGNED);

            return $request->fire();
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

            /** @var GenericRequest $request */
            $request = $this->request('accounts/logout/', new LogoutMessage());

            $request->addPayloadParam('device_id', $this->session->getDevice()->deviceId())
                ->addPayloadParam('one_tap_app_login', true);

            return $request->fire();
        });
    }
}
