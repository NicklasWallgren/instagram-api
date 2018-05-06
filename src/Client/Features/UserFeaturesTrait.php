<?php

namespace Instagram\SDK\Client\Features;

use Exception;
use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\DTO\Messages\HeaderMessage;
use Instagram\SDK\DTO\Messages\User\LogoutMessage;
use Instagram\SDK\DTO\Messages\User\SessionMessage;
use Instagram\SDK\Instagram;
use Instagram\SDK\Requests\Http\Builders\GenericRequestBuilder;
use Instagram\SDK\Requests\Support\SignatureSupport;
use Instagram\SDK\Requests\User\LoginRequest;
use Instagram\SDK\Session\Builders\SessionBuilder;
use function Instagram\SDK\Support\Promises\task;
use function Instagram\SDK\Support\request;

trait UserFeaturesTrait
{

    use DefaultFeaturesTrait;

    /**
     * @var string The login nonce uri
     */
    private static $URI_LOGIN_NONCE = 'accounts/one_tap_app_login/';

    /**
     * @var string The logout uri
     */
    private static $URI_LOGOUT = 'accounts/logout/';

    /**
     * Authenticates a user.
     *
     * @param string $username The username
     * @param string $password The password
     * @throws Exception
     * @return SessionMessage|Promise<InboxMessage>
     */
    public function login(string $username, string $password)
    {
        // Initialize a new session
        $this->session = (new SessionBuilder())->build($this->builder, $this->client);

        return $this->chain(function () use ($username, $password) {
            // Retrieve the header message
            return $this->headers()->then(function (HeaderMessage $message) use ($username, $password) {
                return (new LoginRequest($username, $password, $this->session, $this->client))->fire();
            });
        })($this->getMode());
    }

    /**
     * Authenticates a user using nonce.
     *
     * @param string $nonce
     * @return SessionMessage|Promise<InboxMessage>
     */
    public function loginUsingNonce(string $nonce)
    {
        return task(function () use ($nonce) {
            $this->checkPrerequisites();

            // Build the request instance
            $request = request(self::$URI_LOGIN_NONCE, new SessionMessage())(
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
                    ->setMode(GenericRequestBuilder::$MODE_SIGNED);

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
        return task(function () {
            $this->checkPrerequisites();

            // Build the request instance
            $request = request(self::$URI_LOGOUT, new LogoutMessage())(
                $this,
                $this->session,
                $this->client
            );

            // Prepare the request payload
            $request->setPost('device_id', $this->session->getDevice()->deviceId())
                    ->setPost('one_tap_app_login', true);

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
