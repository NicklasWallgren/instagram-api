<?php

namespace NicklasW\Instagram\Requests\Traits;

use Exception;
use NicklasW\Instagram\Responses\Interfaces\SerializerInterface;
use Psr\Http\Message\RequestInterface;
use function GuzzleHttp\Promise\task;

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
        })->otherwise(function ($exception) use($serializer) {


            var_dump($exception->hasResponse());
            var_dump($exception->getResponse());
//            var_dump($exception->getTraceAsString());
            var_dump($exception->getMessage());

            // handle default exceptions
            // if no response?


            // reject

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