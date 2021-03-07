<?php

declare(strict_types=1);

namespace Instagram\SDK\Exceptions;

use Instagram\SDK\Response\Responses\ResponseEnvelope;

/**
 * Class ApiResponseException
 *
 * @package Instagram\SDK\Exceptions
 */
class ApiResponseException extends InstagramException
{

    /**
     * @var string The default error message
     */
    const DEFAULT_MESSAGE = 'Invalid response';

    /** @var ResponseEnvelope */
    private $response;

    /**
     * ApiResponseException constructor.
     *
     * @param ResponseEnvelope $envelope
     */
    public function __construct(ResponseEnvelope $envelope)
    {
        $this->response = $envelope;

        parent::__construct(self::getMessageOrFallback($envelope), 0, null);
    }

    public function getResponse(): ResponseEnvelope
    {
        return $this->response;
    }

    private static function getMessageOrFallback(ResponseEnvelope $envelope): string
    {
        return $envelope ? $envelope->getMessage() ?? '' : self::DEFAULT_MESSAGE;
    }
}
