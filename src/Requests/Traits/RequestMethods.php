<?php

namespace Instagram\SDK\Requests\Traits;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\DTO\Interfaces\ResponseMessageInterface;
use Instagram\SDK\Http\RequestClient;
use Instagram\SDK\Requests\GenericRequest;
use Instagram\SDK\Responses\Interfaces\SerializerInterface;
use Instagram\SDK\Session\Session;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface as HttpResponseInterface;
use Throwable;
use function GuzzleHttp\Promise\rejection_for;
use function Instagram\SDK\Support\Promises\task;
use function Instagram\SDK\Support\uuid;

/**
 * Trait RequestMethods
 *
 * @package Instagram\SDK\Requests\Traits
 */
trait RequestMethods
{

    /**
     * @var RequestClient
     */
    protected $httpClient;

    /**
     * @var Session
     */
    protected $session;

    /**
     * Adds a unique context to the payload.
     *
     * @param GenericRequest|null $request
     * @return static
     */
    public function addUniqueContext(?GenericRequest $request = null): self
    {
        $request = $request ?: $this;

        $request->setPost('client_context', uuid(true));

        return $request;
    }

    /**
     * Adds the CSRF token.
     *
     * @param GenericRequest|null $request
     * @return static
     * @throws \Exception
     */
    public function addCSRFToken(?GenericRequest $request = null): self
    {
        $request = $request ?: $this;

        $request->setPost('_csrftoken', $this->session->getCsrfToken()->getToken());

        return $request;
    }

    /**
     * Adds the CSRF token and User id to the payload.
     *
     * @param GenericRequest|null $request
     * @return static
     * @throws \Exception
     */
    public function addCSRFTokenAndUserId(?GenericRequest $request = null): self
    {
        $request = $request ?: $this;

        $request->setPost('_csrftoken', $this->session->getCsrfToken()->getToken());
        $request->setPost('_uid', $this->session->getUser()->getId());

        return $request;
    }

    /**
     * Adds the ranked token as a query parameter.
     *
     * @param GenericRequest|null $request
     * @return static
     */
    public function addRankedToken(?GenericRequest $request = null): self
    {
        $request = $request ?: $this;

        $request->setParam('ranked_token', $this->session->getRankedToken());

        return $request;
    }

    /**
     * Adds uuid to the payload.
     *
     * @param GenericRequest|null $request
     * @return self
     */
    public function addUuid(?GenericRequest $request = null): self
    {
        $request = $request ?: $this;

        $request->setPost('_uuid', $this->session->getUuid());

        return $request;
    }

    /**
     * Adds uid to the payload.
     *
     * @param GenericRequest|null $request
     * @return static
     */
    public function addUid(?GenericRequest $request = null): self
    {
        $request = $request ?: $this;

        $request->setPost('_uid', $this->session->getUser()->getId());

        return $request;
    }

    /**
     * Adds Uuid and Uid to the payload.
     *
     * @param GenericRequest|null $request
     * @return static
     */
    public function addUuidAndUid(?GenericRequest $request = null): self
    {
        $request = $request ?: $this;

        // @phan-suppress-next-line PhanPartialTypeMismatchArgument
        $this->addUuid($request);

        // @phan-suppress-next-line PhanPartialTypeMismatchArgument
        $this->addUid($request);

        return $request;
    }

    /**
     * Adds the phone id to the payload.
     *
     * @param GenericRequest|null $request
     * @return static
     */
    public function addPhoneId(?GenericRequest $request = null): self
    {
        $request = $request ?: $this;

        $request->setPost('phone_id', $this->session->getDevice()->phoneId());

        return $request;
    }

    /**
     * Adds the session id to the payload.
     *
     * @param GenericRequest|null $request
     * @return static
     */
    public function addSessionId(?GenericRequest $request = null): self
    {
        $request = $request ?: $this;

        $request->setPost('session_id', $this->session->getSessionId());

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
        $promise = $this->httpClient->requestAsync($request);

        // Return a promise chain
        return $promise->then(function (HttpResponseInterface $response) use ($serializer): PromiseInterface {
            return $this->decode($response, $serializer);
        })->otherwise(function (Throwable $exception) use ($serializer): PromiseInterface {
            if (!$this->isRequestException($exception)) {
                return rejection_for($exception);
            }

            // @phan-suppress-next-line PhanUndeclaredMethod
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
        return task(function () use ($response, $serializer): ResponseMessageInterface {
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
