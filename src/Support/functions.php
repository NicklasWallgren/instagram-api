<?php

namespace Instagram\SDK\Support;

use Closure;
use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\Http\RequestClient as HttpClient;
use Instagram\SDK\Requests\GenericRequest;
use Instagram\SDK\Requests\Http\Builders\AbstractRequestBuilder;
use Instagram\SDK\Requests\Http\Builders\GenericRequestBuilder;
use Instagram\SDK\Requests\Support\SignatureSupport;
use Instagram\SDK\Responses\Serializers\AbstractSerializer;
use Instagram\SDK\Responses\Serializers\GenericSerializer;
use Instagram\SDK\Session\Session;
use function GuzzleHttp\Promise\queue;

/**
 * Generates a universal unique identifier.
 *
 * @param bool $type The identifier type
 * @return string
 */
function uuid(bool $type = SignatureSupport::TYPE_DEFAULT): string
{
    return SignatureSupport::uuid($type);
}

/**
 * Unwrap promise.
 *
 * @param Promise|mixed $value
 * @return mixed
 */
function unwrap($value)
{
    return $value instanceof Promise ? $value->wait() : $value;
}

/**
 * Generates a generic request instance.
 *
 * @param string|AbstractRequestBuilder $uri The request uri or request builder
 * @param Envelope|AbstractSerializer   $serializer The response envelope or serializer
 * @return Closure
 */
function request($uri, $serializer)
{
    return function (Client $client, Session $session, HttpClient $httpClient) use ($uri, $serializer) {
        // Check whether uri corresponds to a request builder
        if (!($uri instanceof AbstractRequestBuilder)) {
            $uri = new GenericRequestBuilder($uri, $session);
        }

        // Check whether serializer corresponds to a abstract serializer
        if (!($serializer instanceof AbstractSerializer)) {
            $serializer = new GenericSerializer($client, $serializer);
        }

        return new GenericRequest($session, $httpClient, $uri, $serializer);
    };
}

/**
 * Adds a function to run in the task queue when it is next `run()` and returns
 * a promise that is fulfilled or rejected with the result.
 *
 * @param callable $task Task function to run.
 *
 * @return PromiseInterface
 */
function task(callable $task)
{
    $queue = queue();
    $promise = new Promise([$queue, 'run']);
    $queue->add(function () use ($task, $promise) {
        try {
            $promise->resolve($task());
        } catch (\Throwable $e) {
            $promise->reject($e);
        } catch (\Exception $e) {
            $promise->reject($e);
        }
    });

    return $promise;
}

/**
 * Given an array of promises, return a promise that is fulfilled when all the
 * items in the array are fulfilled.
 *
 * The promise's fulfillment value is an array with fulfillment values at
 * respective positions to the original array. If any promise in the array
 * rejects, the returned promise is rejected with the rejection reason.
 *
 * @param mixed $promises Promises or values.
 *
 * @return PromiseInterface
 */
function all($promises)
{
    $results = [];
    return each(
        $promises,
        function ($value, $idx) use (&$results) {
            $results[$idx] = $value;
        },
        function ($reason, $idx, Promise $aggregate) {
            $aggregate->reject($reason);
        }
    )->then(function () use (&$results) {
        ksort($results);
        return $results;
    });
}

/**
 * Creates a rejected promise for a reason if the reason is not a promise. If
 * the provided reason is a promise, then it is returned as-is.
 *
 * @param mixed $reason Promise or reason.
 *
 * @return PromiseInterface
 */
function rejection_for($reason)
{
    if ($reason instanceof PromiseInterface) {
        return $reason;
    }

    return new RejectedPromise($reason);
}

/**
 * Creates a promise for a value if the value is not a promise.
 *
 * @param mixed $value Promise or value.
 *
 * @return PromiseInterface
 */
function promise_for($value)
{
    if ($value instanceof PromiseInterface) {
        return $value;
    }

    // Return a Guzzle promise that shadows the given promise.
    if (method_exists($value, 'then')) {
        $wfn = method_exists($value, 'wait') ? [$value, 'wait'] : null;
        $cfn = method_exists($value, 'cancel') ? [$value, 'cancel'] : null;
        $promise = new Promise($wfn, $cfn);
        $value->then([$promise, 'resolve'], [$promise, 'reject']);
        return $promise;
    }

    return new FulfilledPromise($value);
}




// EachPromise
