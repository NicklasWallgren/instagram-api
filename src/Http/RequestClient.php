<?php

namespace Instagram\SDK\Http;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use Instagram\SDK\Http\Guzzle\Client;
use Instagram\SDK\Http\Guzzle\Handlers\HandlerStack;
use Instagram\SDK\Support\Promise;
use Psr\Http\Message\ResponseInterface;

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
     * @param Request $request
     * @return ResponseInterface
     */
    public function request(Request $request): ResponseInterface
    {
        $response = null;

        try {
            $response = $this->client->send($request, $this->options(['cookies' => $this->getCookies()]));
        } catch (ClientException $e) {
            $response = $e->getResponse();

            // Check whether we retrieved a standardalized API request error
            if ($response->getStatusCode() !== 400) {
                throw $e;
            }

            // Retrieve the response envelope content
            $response = $e->getResponse();
        }

        return $response;
    }

    /**
     * Sends the HTTP request.
     *
     * @param Request $request
     * @return Promise
     */
    public function requestAsync(Request $request): Promise
    {
        $response = null;

        try {
            $response = $this->client->sendAsync($request, $this->options(['cookies' => $this->getCookies()]));
        } catch (ClientException $e) {
            $response = $e->getResponse();

            // Check whether we retrieved a standardalized API request error
            if ($response->getStatusCode() !== 400) {
                throw $e;
            }

            // Retrieve the response envelope content
            $response = $e->getResponse();
        }

        return $response;
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
     */
    public function setCookies(CookieJar $cookies)
    {
        $this->cookies = $cookies;
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
     */
    public function setOptions(Options $options)
    {
        $this->options = $options;
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
