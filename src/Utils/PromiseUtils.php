<?php

declare(strict_types=1);

namespace Instagram\SDK\Utils;

use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Promise\Utils;
use Instagram\SDK\Exceptions\InstagramException;
use Throwable;

/**
 * Class PromiseUtils
 *
 * @package Instagram\SDK\Utils
 */
class PromiseUtils
{

    /**
     * Adds a function to run in the task queue when it is next `run()` and returns
     * a promise that is fulfilled or rejected with the result.
     *
     * @param callable $task Task function to run.
     * @return PromiseInterface
     */
    public static function task(callable $task): PromiseInterface
    {
        $queue = Utils::queue();
        $promise = new Promise([$queue, 'run']);
        $queue->add(function () use ($task, $promise) {
            try {
                $promise->resolve($task());
            } catch (InstagramException $e) {
                $promise->reject($e);
            } catch (Throwable $e) {
                $promise->reject(new InstagramException($e->getMessage(), 0, $e));
            }
        });

        return $promise;
    }

    /**
     * Waits until the promise completes if possible.
     *
     * @param PromiseInterface $promise
     * @return mixed
     */
    public static function wait(PromiseInterface $promise)
    {
        try {
            return $promise->wait();
        } catch (InstagramException $e) {
            throw $e;
        } catch (Throwable $e) {
            throw new InstagramException($e->getMessage());
        }
    }

}
