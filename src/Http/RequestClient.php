<?php

namespace Instagram\SDK\Http;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Request;
use Instagram\SDK\Http\Guzzle\Client;
use Instagram\SDK\Http\Guzzle\Handlers\HandlerStack;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class RequestClient
 *
 * @package Instagram\SDK\Http
 */
class RequestClient
{

    /**
     * @var string Get method keyword
     */
    public const METHOD_GET = 'GET';

    /**
     * @var string Post method keyword
     */
    public const METHOD_POST = 'POST';

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var CookieJar
     */
    protected $cookies;

    /**
     * @var Options
     */
    protected $options;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->client = new Client(['handler' => HandlerStack::create()]);
        $this->options = new Options();
    }

    /**
     * Sends the HTTP request.
     *
     * @suppress PhanTypeInvalidThrowsIsInterface
     * @param Request $request
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(Request $request): ResponseInterface
    {
        try {
            $response = $this->client->send($request, $this->options(['cookies' => $this->getCookies()]));
        } catch (ClientException $e) {
            // Retrieve the response envelope content
            $response = $e->getResponse();

            // Check whether we retrieved a standardalized API request error
            if ($response->getStatusCode() !== 400 || $response === null) {
                throw $e;
            }
        }

        return $response;
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
     * @return Options
     */
    public function getOptions(): Options
    {
        return $this->options;
    }

    /**
     * @param Options $options
     * @return static
     */
    public function setOptions(Options $options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Compose the options list.
     *
     * @param array $options
     * @return array
     */
    protected function options(array $options = []): array
    {
        return array_merge($options, $this->options !== null ? $this->options->get() : []);
    }
}
