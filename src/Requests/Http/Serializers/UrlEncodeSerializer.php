<?php

namespace NicklasW\Instagram\Requests\Http\Serializers;

class UrlEncodeSerializer implements SerializerInterface
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