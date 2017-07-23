<?php

namespace Instagram\SDK\Requests\Traits;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Requests\GenericRequest;
use Instagram\SDK\Responses\Interfaces\SerializerInterface;
use Instagram\SDK\Session\Session;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface as HttpResponseInterface;
use Throwable;
use function GuzzleHttp\Promise\rejection_for;
use function Instagram\SDK\Support\Promises\task;
use function Instagram\SDK\Support\uuid;

trait RequestMethods
{

    /**
     * @var Session
     */
    protected $session;

    /**
     * Adds a unique context to the payload.
     *
     * @param GenericRequest|null $request
     * @return GenericRequest
     */
    public function addUniqueContext(?GenericRequest $request = null): GenericRequest
    {
        $request = $request ?: $this;

        $request->setPost('client_context', uuid(true));

        return $request;
    }

    /**
     * Adds the CSRF token and User id to the payload.
     *
     * @param GenericRequest|null $request
     * @return GenericRequest
     */
    public function addCSRFTokenAndUserId(?GenericRequest $request = null): GenericRequest
    {
        $request = $request ?: $this;

        $request->setPost('_csrftoken', $this->session->getCsrfToken()->getToken());
        $request->setPost('_uid', $this->session->getUser()->getId());

        return $request;
    }

    /**
     * Adds the ranked token as a query parameter.
     *
     * @return GenericRequest
     */
    public function addRankedToken(): GenericRequest
    {
        $this->setParam('ranked_token', $this->session->getRankedToken());

        return $this;
    }

    /**
     * Asynchronous request.
     *
     * @param RequestInterface    $request
     * @param SerializerInterface $serializer
     * @return mixed
     */
    protected function request(RequestInterface $request, SerializerInterface $serializer)
    {
        // Execute the asynchronous request
        $promise = $this->httpClient->requestAsync($request);

        // Return a promise chain
        return $promise->then(function ($response) use ($serializer) {
            return $this->decode($response, $serializer);
        })->otherwise(function ($exception) use ($serializer) {

            // Use internal rejection_for

            if (!$this->isRequestException($exception)) {
                return rejection_for($exception);
            }

            return $this->decode($exception->getResponse(), $serializer);
        });
    }

    /**
     * Decode the response.
     *
     * @param HttpResponseInterface $response
     * @param SerializerInterface   $serializer
     * @return PromiseInterface
     */
    protected function decode(HttpResponseInterface $response, SerializerInterface $serializer)
    {
        // Compose a task, reject promise on failure
        return task(function () use ($response, $serializer) {
            // Queue the serialization
            return $serializer->decode($response);
        });
    }

    /**
     * Returns true if the exception is of request exception, false otherwise.
     *
     * @param Throwable $exception
     * @return bool
     */
    protected function isRequestException(Throwable $exception)
    {
        return $exception instanceof RequestException;
    }
}
