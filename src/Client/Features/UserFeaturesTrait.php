<?php

namespace Instagram\SDK\Client\Features;

use Exception;
use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\DTO\Messages\HeaderMessage;
use Instagram\SDK\DTO\Messages\User\LogoutMessage;
use Instagram\SDK\DTO\Messages\User\SessionMessage;
use Instagram\SDK\Instagram;
use Instagram\SDK\Requests\User\LoginRequest;
use Instagram\SDK\Session\Builders\SessionBuilder;
use function Instagram\SDK\Support\request;
use function Instagram\SDK\Support\task;

trait UserFeaturesTrait
{

    use DefaultFeaturesTrait;

    /**
     * @var string The message broadcast uri
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
     * Logout the authenticated user.
     *
     * @return LogoutMessage|Promise<LogoutMessage>
     */
    public function logout()
    {
        return task(function () {
            $this->checkPrerequisites();

            // Build the request instance
            $request = request(self::$URI_LOGOUT, new LogoutMessage())($this, $this->session,
                $this->client);

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
