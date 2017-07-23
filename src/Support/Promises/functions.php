<?php

namespace Instagram\SDK\Support\Promises;

use GuzzleHttp\Promise\FulfilledPromise;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Promise\RejectedPromise;
use Instagram\SDK\Support\Promise;
use function GuzzleHttp\Promise\queue;

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
