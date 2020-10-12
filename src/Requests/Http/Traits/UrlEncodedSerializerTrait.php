<?php

namespace Instagram\SDK\Requests\Http\Traits;

use Instagram\SDK\Requests\Http\Serializers\RequestSerializerInterface;
use Instagram\SDK\Requests\Http\Serializers\UrlEncodeRequestSerializer;

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
     * @return RequestSerializerInterface
     */
    protected function serializer(): RequestSerializerInterface
    {
        return new UrlEncodeRequestSerializer();
    }
}
