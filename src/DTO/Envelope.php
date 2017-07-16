<?php

namespace Instagram\SDK\DTO;

use Instagram\SDK\DTO\Interfaces\PropertiesInterface;
use Instagram\SDK\DTO\Interfaces\ResponseMessageInterface;
use Instagram\SDK\DTO\Traits\PropertiesTrait;
use Instagram\SDK\Responses\Serializers\Traits\OnPropagateDecodeEventTrait;
use Traits\MappableTrait;

class Envelope implements ResponseMessageInterface, PropertiesInterface
{

    use MappableTrait;
    use PropertiesTrait;
    use OnPropagateDecodeEventTrait;

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
    public function isSuccess()
    {
        return $this->status === static::STATUS_SUCCESS;
    }
}
