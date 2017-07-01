<?php

namespace Instagram\SDK\Requests\Traits;

use Instagram\SDK\Requests\GenericRequest;
use Instagram\SDK\Responses\Interfaces\SerializerInterface;
use Instagram\SDK\Session\Session;
use Psr\Http\Message\RequestInterface;
use function GuzzleHttp\Promise\task;
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
        $request = $request?: $this;

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
        $request = $request?: $this;

        $request->setPost('_csrftoken', $this->session->getCsrfToken()->getToken());
        $request->setPost('_uid', $this->session->getUser()->getId());

        return $request;
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
        $response = $this->httpClient->requestAsync($request);

        // Return a promise chain
        return $response->then(function () use ($response, $serializer) {
            // Compose a task, reject promise on failure
            return task(function () use ($response, $serializer) {
                // Queue the serialization
                return $serializer->decode($response->wait());
            });
        })->otherwise(function ($exception) use ($serializer) {
            // Retrieve the response
            $response = $exception->getResponse();

            // Compose a task, reject promise on failure
            return task(function () use ($response, $serializer) {
                // Queue the serialization
                return $serializer->decode($response);
            });
        });
    }
}
