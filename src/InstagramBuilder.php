<?php

declare(strict_types=1);

namespace Instagram\SDK;

use Instagram\SDK\Client\Client;
use Instagram\SDK\Device\DeviceBuilderInterface;
use Instagram\SDK\Session\Session;

/**
 * Class InstagramBuilder
 *
 * @package Instagram\SDK
 */
final class InstagramBuilder
{

    /** @var DeviceBuilderInterface|null */
    private $deviceBuilder;

    /** @var Session|null */
    private $session;

    /** @var string|null */
    private $proxyUri;

    /**
     * @param DeviceBuilderInterface $deviceBuilder
     * @return static
     */
    public function setDeviceBuilder(DeviceBuilderInterface $deviceBuilder)
    {
        $this->deviceBuilder = $deviceBuilder;
        return $this;
    }

    /**
     * @param Session $session
     * @return static
     */
    public function setSession(Session $session)
    {
        $this->session = $session;
        return $this;
    }

    /**
     * @param string $proxyUri
     * @return static
     */
    public function setProxyUri(string $proxyUri)
    {
        $this->proxyUri = $proxyUri;
        return $this;
    }

    /**
     * Create a {@link Instagram} instance.
     *
     * @return Instagram
     */
    public function build(): Instagram
    {
        $client = new Client($this->deviceBuilder, $this->session, $this->proxyUri);

        return new Instagram($client);
    }
}
