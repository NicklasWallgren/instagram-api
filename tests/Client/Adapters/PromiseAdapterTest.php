<?php

namespace Instagram\SDK\Client\Adapters;

use Exception;
use GuzzleHttp\Promise\Promise;
use PHPUnit\Framework\TestCase;

class PromiseAdapterTest extends TestCase
{

    /**
     * @var PromiseAdapter
     */
    protected $adapter;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->adapter = new PromiseAdapter();
    }

    /**
     * @test
     */
    public function testRunMethod()
    {
        // Invoke the run method
        $promise = $this->adapter->run(function() {
            return 'value';
        });

        // Assert promise
        $this->assertInstanceOf(Promise::class, $promise);

        // Assert unwrap value
        $this->assertEquals('value', $promise->wait());
    }

    /**
     * @test
     */
    public function testExceptionInClosure()
    {
        // Invoke the run method
        $promise = $this->adapter->run(function() {
            throw new Exception();
        });

        // Assert promise
        $this->assertInstanceOf(Promise::class, $promise);

        // Assert exception when finalizing the promise
        $this->expectException(Exception::class);

        // Unwrap
        $promise->wait();
    }

}
