<?php

namespace Instagram\SDK\Client;

use Exception;
use Instagram\SDK\Client\Features\AccountFeaturesTrait;
use Instagram\SDK\Client\Features\DirectFeaturesTrait;
use Instagram\SDK\Client\Features\DiscoverFeaturesTrait;
use Instagram\SDK\Client\Features\FeedFeaturesTrait;
use Instagram\SDK\Client\Features\FriendshipsFeaturesTrait;
use Instagram\SDK\Client\Features\GeneralFeaturesTrait;
use Instagram\SDK\Client\Features\MediaFeaturesTrait;
use Instagram\SDK\Client\Features\SearchFeaturesTrait;
use Instagram\SDK\Client\Features\UsersFeaturesTrait;
use Instagram\SDK\Devices\Builders\DeviceBuilder;
use Instagram\SDK\Devices\Interfaces\DeviceBuilderInterface;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\Http\RequestClient;
use Instagram\SDK\Requests\GenericRequest;
use Instagram\SDK\Session\Session;
use function Instagram\SDK\Support\request;

/**
 * Class Client
 *
 * @package Instagram\SDK\Client
 */
class Client
{

    use DiscoverFeaturesTrait;
    use GeneralFeaturesTrait;
    use AccountFeaturesTrait;
    use DirectFeaturesTrait;
    use SearchFeaturesTrait;
    use FeedFeaturesTrait;
    use FriendshipsFeaturesTrait;
    use MediaFeaturesTrait;
    use UsersFeaturesTrait;

    /**
     * @var RequestClient The Http client
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
     * @param DeviceBuilderInterface|null $builder
     */
    public function __construct(?DeviceBuilderInterface $builder = null)
    {
        $this->client = new RequestClient();
        $this->builder = $builder ?: new DeviceBuilder();
    }

    /**
     * Returns the current session.
     *
     * @return Session|null
     */
    public function getSession(): ?Session
    {
        return $this->session;
    }

    /**
     * Sets the current session.
     *
     * @param Session $session
     * @return self
     */
    public function setSession(Session $session): self
    {
        $this->session = $session;

        $this->client->setCookies($session->getCookies());

        return $this;
    }

    /**
     * Sets the proxy uri.
     *
     * @param string $uri
     * @return self
     */
    public function setProxyUri(string $uri): self
    {
        $this->client->getOptions()->addProxyUri($uri);

        return $this;
    }

    /**
     * Validate the state.
     *
     * @return void
     * @throws Exception
     */
    protected function checkPrerequisites(): void
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

    /**
     * Creates a generic request.
     *
     * @param string   $uri
     * @param Envelope $message
     * @param string   $method
     * @return GenericRequest
     */
    protected function request(string $uri, Envelope $message, string $method = 'POST'): GenericRequest
    {




        return request($uri, $message, $method)(
            $this,
            $this->session,
            $this->client
        );
    }

    /**
     * @inheritDoc
     */
    public function __debugInfo()
    {
        return [];
    }
}
