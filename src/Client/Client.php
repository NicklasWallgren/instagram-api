<?php

namespace NicklasW\Instagram\Client;

use Exception;
use NicklasW\Instagram\Devices\Builders\DeviceBuilder;
use NicklasW\Instagram\Devices\Interfaces\DeviceBuilderInterface;
use NicklasW\Instagram\DTO\CsrfTokenMessage;
use NicklasW\Instagram\DTO\Messages\HeaderMessage;
use NicklasW\Instagram\DTO\Messages\SessionMessage;
use NicklasW\Instagram\DTO\Messages\ThreadMessage;
use NicklasW\Instagram\HttpClients\Client as HttpClient;
use NicklasW\Instagram\Requests\HeaderRequest;
use NicklasW\Instagram\Requests\InboxRequest;
use NicklasW\Instagram\Requests\LoginRequest;
use NicklasW\Instagram\Requests\Support\SignatureSupport;
use NicklasW\Instagram\Requests\ThreadRequest;
use NicklasW\Instagram\Session\Builders\SessionBuilder;
use NicklasW\Instagram\Session\Session;

class Client
{

    /**
     * @var HttpClient The Http client
     */
    protected $client;

    /**
     * @var Session
     */
    protected $session;

    /**
     * @var DeviceBuilderInterface
     */
    protected $builder;

    /**
     * Client constructor.
     *
     * @param ClientInterface        $client
     * @param DeviceBuilderInterface $builder
     */
    public function __construct(ClientInterface $client = null, DeviceBuilderInterface $builder = null)
    {
        $this->client = new HttpClient($client);
        $this->builder = new DeviceBuilder();
    }

    /**
     * Returns the current session.
     *
     * @return Session
     */
    public function getSession(): Session
    {
        return $this->session;
    }

    /**
     * Sets the current session.
     *
     * @param Session $session
     */
    public function setSession(Session $session)
    {
        $this->session = $session;

        $this->client->setCookies($session->getCookies());
    }

    /**
     * Login a user.
     *
     * @param string $username
     * @param string $password
     * @throws Exception
     * @return SessionMessage
     */
    public function login(string $username, string $password): SessionMessage
    {
        // Initialize a new session
        $this->session = (new SessionBuilder())->build($username, $password, $this->builder);

        // Retrieve the header message
        $message = $this->headers();

        // Add the CSRF token onto the session
        $this->session->setCsrfToken($message->getToken());

        return (new LoginRequest($username, $password, $this->session, $this->client))->fire();
    }

    /**
     * Retrieves the inbox.
     */
    public function inbox()
    {
        // Client, SessionMessage

        $this->checkPrerequisites();

        return (new InboxRequest($this, $this->session, $this->client))->fire();
    }

    /**
     * Retrieves a thread.
     *
     * @param string      $id
     * @param string|null $cursor
     * @return ThreadMessage
     */
    public function thread(string $id, ?string $cursor = null)
    {
        // Client, SessionMessage

        $this->checkPrerequisites();

        return (new ThreadRequest($this, $this->session, $this->client, $id, $cursor))->fire();
    }

    /**
     * Returns the headers.
     *
     * @return HeaderMessage
     * @throws Exception
     */
    protected function headers(): HeaderMessage
    {
        // Check whether the user is authenticated or not
        if (!$this->isSessionAvailable()) {
            throw new Exception('The session is not available. Please authenticate first');
        }

        $response = (new HeaderRequest(SignatureSupport::uuid(SignatureSupport::TYPE_COMBINED),
            $this->session, $this->client))->fire();

        return $response;
    }

    /**
     * Validate the state.
     *
     * @throws Exception
     */
    protected function checkPrerequisites()
    {
        // Check whether the user is authenticated or not
        if (!$this->isSessionAvailable()) {
            throw new Exception('Session is missing. Please log in.');
        }
    }

    /**
     * Returns true if session is available, false otherwise.
     *
     * @return bool
     */
    protected function isSessionAvailable(): bool
    {
        return true;
    }

    /**
     * Returns true whether a user is authenticated, false otherwise.
     *
     * @return bool
     */
    protected function isAuthenticated(): bool
    {
        return true;
    }

}