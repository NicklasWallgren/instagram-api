<?php

namespace Instagram\SDK\Requests\Http\Traits;

use Instagram\SDK\Requests\Http\Serializers\SerializerInterface;
use Instagram\SDK\Requests\Http\Serializers\UrlEncodeSerializer;

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
     * @return SerializerInterface
     */
    protected function serializer(): SerializerInterface
    {
        return new UrlEncodeSerializer();
    }
}
