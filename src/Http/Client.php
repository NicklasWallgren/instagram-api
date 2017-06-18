<?php

namespace NicklasW\Instagram\Http;

use Exception;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class Client
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
     * @var string The endpoint url
     */
    protected const ENDPOINT_URL = '';

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
     * @param ClientInterface $client
     */
    public function __construct(?ClientInterface $client = null)
    {
        $this->client = $client ?: new HttpClient();
    }

    /**
     * Sends a GET HTTP request.
     *
     * @param string $uri
     * @param array  $query
     * @return ResponseInterface
     */
    public function get(string $uri, ?array $query = []): ResponseInterface
    {
        return $this->send(self::METHOD_GET, $uri, null, $query);
    }

    /**
     * Sends a POST HTTP request.
     *
     * @param string      $uri
     * @param array       $query
     * @param string|null $body
     * @return ResponseInterface
     */
    public function post(string $uri, array $query = [], ?string $body = null): ResponseInterface
    {
        return $this->send(self::METHOD_POST, $uri, $body, $query);
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
     * Send a HTTP request.
     *
     * @param string                               $method
     * @param string                               $uri
     * @param string|null|resource|StreamInterface $body
     * @param array                                $query
     * @param array                                $headers
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function send($method, $uri, $body = null, $query = [], $headers = []): ResponseInterface
    {
        return $this->client->send(new Request($method, $uri, $headers, $body));
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