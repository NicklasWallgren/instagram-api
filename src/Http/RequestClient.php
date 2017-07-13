<?php

namespace Instagram\SDK\Http;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use Instagram\SDK\Http\Handlers\HandlerStack;
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
     * Client constructor.
     *
     */
    public function __construct()
    {
        $this->client = new HttpClient(['handler' => HandlerStack::create()]);
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
            $response = $this->client->send($request, ['cookies' => $this->getCookies()]);
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
            $response = $this->client->sendAsync($request, ['cookies' => $this->getCookies()]);
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
}
