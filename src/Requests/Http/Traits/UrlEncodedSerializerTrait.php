<?php

namespace Instagram\SDK\Requests\Http\Traits;

use Instagram\SDK\Requests\Http\Serializers\PayloadSerializerInterface;
use Instagram\SDK\Requests\Http\Serializers\UrlEncodePayloadSerializer;

/**
 * Trait UrlEncodedSerializerTrait
 *
 * @package Instagram\SDK\Requests\Http\Traits
 */
trait UrlEncodedSerializerTrait
{

    /**
     * The request body serializer.
     *
     * @return PayloadSerializerInterface
     */
    protected function serializer(): PayloadSerializerInterface
    {
        return new UrlEncodePayloadSerializer();
    }
}
