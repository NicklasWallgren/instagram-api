<?php

namespace Instagram\SDK\Http;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\RequestInterface;

/**
 * Class RequestClient
 *
 * @package Instagram\SDK\Http
 */
class HttpClient
{

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var CookieJar
     */
    private $cookies;

    /**
     * @var HttpClientConfiguration
     */
    private $configuration;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->client = new Client(['handler' => HandlerStack::create()]);
        $this->configuration = new HttpClientConfiguration();
    }

    /**
     * Sends the HTTP request.
     *
     * @param RequestInterface $request
     * @return PromiseInterface
     */
    public function requestAsync(RequestInterface $request): PromiseInterface
    {
        return $this->client->sendAsync($request, $this->options(['cookies' => $this->getCookies()]));
    }

    /**
     * Returns the cookies.
     *
     * @return CookieJar
     */
    public function getCookies(): CookieJar
    {
        if ($this->cookies === null) {
            $this->cookies = new CookieJar();
        }

        return $this->cookies;
    }

    /**
     * Sets the cookies.
     *
     * @param CookieJar $cookies
     * @return static
     */
    public function setCookies(CookieJar $cookies)
    {
        $this->cookies = $cookies;

        return $this;
    }

    /**
     * @return HttpClientConfiguration
     */
    public function getConfiguration(): HttpClientConfiguration
    {
        return $this->configuration;
    }

    /**
     * @param HttpClientConfiguration $configuration
     * @return static
     */
    public function setConfiguration(HttpClientConfiguration $configuration)
    {
        $this->configuration = $configuration;

        return $this;
    }

    /**
     * Compose the options list.
     *
     * @param array<string, mixed> $options
     * @return array<string, mixed>
     */
    protected function options(array $options = []): array
    {
        return array_merge($options, $this->configuration !== null ? $this->configuration->toArray() : []);
    }
}
