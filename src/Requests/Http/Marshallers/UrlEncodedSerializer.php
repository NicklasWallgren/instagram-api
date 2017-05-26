<?php

namespace NicklasW\Instagram\Requests\Http\Marshallers;

class UrlEncodedSerializer implements SerializerInterface
{

    /**
     * Encodes the body.
     *
     * @param array $body
     * @return string
     */
    public function encode($body): string
    {
        return http_build_query($body, '', '&');
    }

}