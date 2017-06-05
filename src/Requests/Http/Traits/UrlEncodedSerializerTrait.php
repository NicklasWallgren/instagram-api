<?php

namespace NicklasW\Instagram\Requests\Http\Traits;

use NicklasW\Instagram\Requests\Http\Marshallers\SerializerInterface;
use NicklasW\Instagram\Requests\Http\Marshallers\UrlEncodedSerializer;

trait UrlEncodedSerializerTrait
{

    /**
     * The request body serializer.
     *
     * @return SerializerInterface
     */
    protected function serializer(): SerializerInterface
    {
        return new UrlEncodedSerializer();
    }

}