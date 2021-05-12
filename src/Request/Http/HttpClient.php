<?php

declare(strict_types=1);

namespace Instagram\SDK\Request\Http;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\RequestInterface;

/**
 * Class HttpClient
 *
 * @package Instagram\SDK\Request\Http
 */
class HttpClient
{

    /** @var ClientInterface */
    private $client;

    /** @var CookieJar */
    private $cookies;

    /** @var HttpClientConfiguration */
    private $configuration;

    /**
     * HttpClient constructor.
     *
     * @param CookieJar|null              $cookies
     * @param HttpClientConfiguration|null $configuration
     */
    public function __construct(?CookieJar $cookies, ?HttpClientConfiguration $configuration)
    {
        $this->client = new Client(['handler' => HandlerStack::create()]);
        $this->cookies = $cookies ?: new CookieJar();
        $this->configuration = $configuration ?: new HttpClientConfiguration();
    }

    /**
     * Send an HTTP request.
     *
     * @param RequestInterface $request
     * @return PromiseInterface
     */
    public function requestAsync(RequestInterface $request): PromiseInterface
    {
        return $this->client->sendAsync($request, $this->options(['cookies' => $this->getCookies()]));
    }

    /**
     * @return CookieJar
     */
    public function getCookies(): CookieJar
    {
        return $this->cookies;
    }

    /**
     * @return HttpClientConfiguration
     */
    public function getConfiguration(): HttpClientConfiguration
    {
        return $this->configuration;
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
