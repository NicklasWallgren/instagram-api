<?php

namespace NicklasW\Instagram\Requests\Traits;

use function GuzzleHttp\Promise\task;
use NicklasW\Instagram\Responses\Interfaces\SerializerInterface;
use Psr\Http\Message\RequestInterface;

trait RequestMethods
{

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
        });
    }

}