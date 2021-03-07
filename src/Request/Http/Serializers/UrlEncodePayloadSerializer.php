<?php

declare(strict_types=1);

namespace Instagram\SDK\Request\Http\Serializers;

/**
 * Class UrlEncodeSerializer
 *
 * @package Instagram\SDK\Request\Http\Serializers
 */
class UrlEncodePayloadSerializer implements PayloadSerializerInterface
{

    /**
     * @inheritdoc
     */
    public function encode(array $payload): string
    {
        return http_build_query($payload, '', '&');
    }
}
