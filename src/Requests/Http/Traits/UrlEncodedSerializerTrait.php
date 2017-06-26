<?php

namespace NicklasW\Instagram\Requests\Http\Traits;

use NicklasW\Instagram\Requests\Http\Serializers\SerializerInterface;
use NicklasW\Instagram\Requests\Http\Serializers\UrlEncodeSerializer;

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
