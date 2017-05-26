<?php

namespace NicklasW\Instagram\DTO;

use NicklasW\Instagram\DTO\Interfaces\ResponseMessageInterface;

class Envelope implements ResponseMessageInterface
{

    /**
     * @var string The success status
     */
    const STATUS_SUCCESS = 'ok';

    /**
     * @var string The error status
     */
    const STATUS_ERROR = 'fail';

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     * @name error_type
     */
    protected $errorType;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var bool
     * @name invalid_credentials
     */
    protected $invalidCredentials;

    /**
     * Envelope constructor.
     *
     * @param string $message
     */
    public function __construct(?string $message = null)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getErrorType()
    {
        return $this->errorType;
    }

    /**
     * @return string
     */
    public function getMessage(): string
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
    public function isSuccess()
    {
        return $this->status === static::STATUS_SUCCESS;
    }

}