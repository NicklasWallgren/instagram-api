<?php

namespace NicklasW\Instagram\Responses\Interfaces;

use NicklasW\Instagram\DTO\Interfaces\ResponseMessageInterface;
use Psr\Http\Message\ResponseInterface as HttpResponseInterface;

interface SerializerInterface
{

    /**
     * Decodes the response message.
     *
     * @param HttpResponseInterface $response
     * @return ResponseMessageInterface
     */
    public function decode(HttpResponseInterface $response): ResponseMessageInterface;

}