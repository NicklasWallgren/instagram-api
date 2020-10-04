<?php

namespace Instagram\SDK\Requests\Http\Serializers;

/**
 * Class UrlEncodeSerializer
 *
 * @package Instagram\SDK\Requests\Http\Serializers
 */
class UrlEncodeSerializer implements SerializerInterface
{

    /**
     * Encodes the body.
     *
     * @param array<string, mixed> $body
     * @return string
     */
    public function encode(array $body): string
    {
        return http_build_query($body, '', '&');
    }
}
