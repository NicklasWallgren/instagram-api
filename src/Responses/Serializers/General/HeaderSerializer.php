<?php

namespace NicklasW\Instagram\Responses\Serializers\General;

use NicklasW\Instagram\DTO\Envelope;
use NicklasW\Instagram\DTO\Interfaces\ResponseMessageInterface;
use NicklasW\Instagram\DTO\Messages\HeaderMessage;
use NicklasW\Instagram\Responses\Exceptions\InvalidResponseException;
use NicklasW\Instagram\Responses\Serializers\AbstractSerializer;
use NicklasW\Instagram\Responses\Traits\CsrfTokenRetrieverTrait;
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