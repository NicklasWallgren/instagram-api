<?php

namespace Instagram\SDK\Client\Features;

use Exception;
use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\DTO\Messages\HeaderMessage;
use Instagram\SDK\DTO\Messages\SessionMessage;
use Instagram\SDK\Instagram;
use Instagram\SDK\Requests\User\LoginRequest;
use Instagram\SDK\Session\Builders\SessionBuilder;

trait UserFeaturesTrait
{

    use DefaultFeaturesTrait;

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
        })($this->mode);
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
