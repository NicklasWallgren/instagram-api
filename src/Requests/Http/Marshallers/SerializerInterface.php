<?php

namespace NicklasW\Instagram\Requests\Http\Marshallers;

use Psr\Http\Message\StreamInterface;

interface SerializerInterface
{

    /**
     * Encodes the body.
     *
     * @param mixed $body
     * @return null|StreamInterface|resource|string
     */
    public function encode($body);

}