<?php

namespace Instagram\SDK\Responses\Serializers\General;

use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\Interfaces\ResponseMessageInterface;
use Instagram\SDK\DTO\Messages\HeaderMessage;
use Instagram\SDK\Responses\Exceptions\InvalidResponseException;
use Instagram\SDK\Responses\Serializers\AbstractSerializer;
use Instagram\SDK\Responses\Traits\CsrfTokenRetrieverTrait;
use Psr\Http\Message\ResponseInterface as HttpResponseInterface;

class HeaderSerializer extends AbstractSerializer
{

    use CsrfTokenRetrieverTrait;

    /**
     * Decodes the response message.
     *
     * @param HttpResponseInterface $response
     * @return ResponseMessageInterface
     * @throws InvalidResponseException
     */
    public function decode(HttpResponseInterface $response): ResponseMessageInterface
    {
        if (!$this->isValidHttpResponse($response)) {
            throw new InvalidResponseException();
        }

        return (new HeaderMessage())->setToken($this->getCsrfToken($response));
    }

    /**
     * Returns the message implementation.
     *
     * @return Envelope
     */
    protected function message(): ?Envelope
    {
        return null;
    }
}
