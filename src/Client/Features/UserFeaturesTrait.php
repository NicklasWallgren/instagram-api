<?php

namespace Instagram\SDK\Client\Features;

use Exception;
use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\DTO\Messages\User\LogoutMessage;
use Instagram\SDK\DTO\Messages\User\SessionMessage;
use Instagram\SDK\Instagram;
use Instagram\SDK\Requests\GenericRequest;
use Instagram\SDK\Requests\Http\Factories\SerializerFactory;
use Instagram\SDK\Requests\Support\SignatureSupport;
use Instagram\SDK\Requests\User\LoginRequest;
use Instagram\SDK\Session\Builders\SessionBuilder;
use Instagram\SDK\Support\Promise;
use function Instagram\SDK\Support\Promises\task;
use function Instagram\SDK\Support\request;

/**
 * Trait UserFeaturesTrait
 *
 * @package            Instagram\SDK\Client\Features
 * @phan-file-suppress PhanUnreferencedUseNormal
 */
trait UserFeaturesTrait
{

    use DefaultFeaturesTrait;

    /**
     * Authenticates a user.
     *
     * @param string $username The username
     * @param string $password The password
     * @return SessionMessage|Promise<SessionMessage>
     * @throws Exception
     */
    public function login(string $username, string $password)
    {
        // Initialize a new session
        $this->session = (new SessionBuilder())->build($this->builder, $this->client);

        return $this->chain(function () use ($username, $password): Promise {
            // @phan-suppress-next-line PhanUndeclaredMethod
            return $this->headers()->then(function () use ($username, $password): Promise {
                return (new LoginRequest($username, $password, $this->session, $this->client))->fire();
            });
        })($this->getMode());
    }

    /**
     * Authenticates a user using nonce.
     *
     * @param string $nonce
     * @return SessionMessage|Promise<SessionMessage>
     */
    public function loginUsingNonce(string $nonce)
    {
        return task(function () use ($nonce): Promise {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            /** @var GenericRequest $request */
            $request = request('accounts/one_tap_app_login/', new SessionMessage())(
                $this,
                $this->session,
                $this->client
            );

            // Prepare the payload
            $body = [
                'device_id'   => $this->session->getDevice()->deviceId(),
                'user_id'     => $this->session->getUser()->getId(),
                'login_nonce' => $nonce,
                'adid'        => SignatureSupport::uuid(),
            ];

            $request->setPayload($body)
                ->setSerializerType(SerializerFactory::TYPE_SIGNED);

            // Invoke the request
            return $request->fire();
        })($this->getMode());
    }

    /**
     * Logout the authenticated user.
     *
     * @return LogoutMessage|Promise<LogoutMessage>
     */
    public function logout()
    {
        return task(function (): Promise {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            /** @var GenericRequest $request */
            $request = request('accounts/logout/', new LogoutMessage())(
                $this,
                $this->session,
                $this->client
            );

            // Prepare the request payload
            $request->addPayloadParam('device_id', $this->session->getDevice()->deviceId())
                ->addPayloadParam('one_tap_app_login', true);

            // Invoke the request
            return $request->fire();
        })($this->getMode());
    }

    /**
     * Chain multiple requests.
     *
     * @param callable $callback
     * @return PromiseInterface
     */
    protected function chain(callable $callback): PromiseInterface
    {
        // Store the current mode
        $mode = $this->mode;

        // Temporary change the mode
        $this->mode = Instagram::MODE_PROMISE;

        try {
            return $callback();
        } finally {
            // Restore the old mode
            $this->mode = $mode;
        }
    }
}
