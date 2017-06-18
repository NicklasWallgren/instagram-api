<?php

namespace NicklasW\Instagram\Client;

use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Promise\Promise;
use NicklasW\Instagram\Client\Adapters\Interfaces\AdapterInterface;
use NicklasW\Instagram\Client\Adapters\UnwrapAdapter;
use NicklasW\Instagram\Client\Features\DiscoverFeatures;
use NicklasW\Instagram\Client\Features\DiscoverFeaturesTrait;
use NicklasW\Instagram\Devices\Builders\DeviceBuilder;
use NicklasW\Instagram\Devices\Interfaces\DeviceBuilderInterface;
use NicklasW\Instagram\DTO\CsrfTokenMessage;
use NicklasW\Instagram\DTO\Messages\HeaderMessage;
use NicklasW\Instagram\DTO\Messages\InboxMessage;
use NicklasW\Instagram\DTO\Messages\SessionMessage;
use NicklasW\Instagram\DTO\Messages\ThreadMessage;
use NicklasW\Instagram\Http\Client as HttpClient;
use NicklasW\Instagram\Requests\Direct\InboxRequest;
use NicklasW\Instagram\Requests\Direct\ThreadRequest;
use NicklasW\Instagram\Requests\General\HeaderRequest;
use NicklasW\Instagram\Requests\Support\SignatureSupport;
use NicklasW\Instagram\Requests\User\LoginRequest;
use NicklasW\Instagram\Session\Builders\SessionBuilder;
use NicklasW\Instagram\Session\Session;
use function GuzzleHttp\Promise\task;
use function NicklasW\Instagram\Support\uuid;

class Client
{

    use DiscoverFeaturesTrait;

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
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * Client constructor.
     *
     * @param ClientInterface        $client
     * @param DeviceBuilderInterface $builder
     * @param AdapterInterface|null  $adapter
     */
    public function __construct(
        ?ClientInterface $client = null,
        ?DeviceBuilderInterface $builder = null,
        ?AdapterInterface $adapter = null
    ) {
        $this->client = new HttpClient($client);
        $this->builder = $builder ?: new DeviceBuilder();
        $this->adapter = $adapter ?: new UnwrapAdapter();
    }

    /**
     * Returns the current session.
     *
     * @return Session
     */
    public function getSession(): ?Session
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
     * Sets the adapter.
     *
     * @param AdapterInterface $adapter
     */
    public function setAdapter(AdapterInterface $adapter): void
    {
        $this->adapter = $adapter;
    }

    /**
     * @return AdapterInterface
     */
    public function getAdapter(): AdapterInterface
    {
        return $this->adapter;
    }

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

    /**
     * Retrieves the inbox.
     *
     * @throws Exception
     * @return InboxMessage|Promise<InboxMessage>
     */
    public function inbox()
    {
        return $this->adapter->run(function () {
            $this->checkPrerequisites();

            return (new InboxRequest($this, $this->session, $this->client))->fire();
        });
    }

    /**
     * Retrieves a thread.
     *
     * @param string      $id     The thread id
     * @param string|null $cursor The cursor id
     * @throws Exception
     * @return ThreadMessage|Promise<ThreadMessage>
     */
    public function thread(string $id, ?string $cursor = null)
    {
        return $this->adapter->run(function () use ($id, $cursor) {
            $this->checkPrerequisites();

            return (new ThreadRequest($this, $this->session, $this->client, $id, $cursor))->fire();
        });
    }

    /**
     * Returns the headers containing the initial CSRF token.
     *
     * @throws Exception
     * @return Promise<HeaderMessage>
     */
    protected function headers()
    {
        return task(function () {
            // Check whether the user is authenticated or not
            if (!$this->isSessionAvailable()) {
                return new Exception('The session is not available. Please authenticate first');
            }

            return (new HeaderRequest(uuid(SignatureSupport::TYPE_COMBINED), $this->session, $this->client))->fire();
        });
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
        return $this->session !== null;
    }

}