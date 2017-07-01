<?php

namespace Instagram\SDK\Client\Features;

use Exception;
use GuzzleHttp\Promise\Promise;
use Instagram\SDK\DTO\Messages\HeaderMessage;
use Instagram\SDK\DTO\Messages\SessionMessage;
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
        $this->session = (new SessionBuilder())->build($this->builder);

        return $this->adapter->run(function () use ($username, $password) {
            // Retrieve the header message
            return $this->headers()->then(function (HeaderMessage $message) use ($username, $password) {
                // Add the CSRF token onto the session
                $this->session->setCsrfToken($message->getToken());

                return (new LoginRequest($username, $password, $this->session, $this->client))->fire();
            });
        });
    }
}
