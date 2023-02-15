<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Responses;

use Psr\Http\Message\ResponseInterface as HttpResponseInterface;

/**
 * Class ResponseEnvelope
 *
 * @package Instagram\SDK\Response\Responses
 */
abstract class ResponseEnvelope implements ResponseInterface
{

    const STATUS_SUCCESS = 'ok';
    const STATUS_ERROR = 'fail';

    /** @var string */
    protected $status;

    /** @var string */
    protected $errorType;

    /** @var string|null */
    protected $message;

    /** @var bool */
    protected $invalidCredentials;

    /** @var HttpResponseInterface|null */
    protected $rawResponse;

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @return string|null
     */
    public function getErrorType(): ?string
    {
        return $this->errorType;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @return bool
     */
    public function getInvalidCredentials(): bool
    {
        return $this->invalidCredentials;
    }

    /**
     * Returns true if the request was successful.
     *
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->status === static::STATUS_SUCCESS;
    }

    /** @inheritdoc */
    public function getRawResponse(): HttpResponseInterface
    {
        return $this->rawResponse;
    }

    /** @inheritdoc */
    public function setRawResponse(HttpResponseInterface $response): ResponseInterface
    {
        $this->rawResponse = $response;

        return $this;
    }
}
