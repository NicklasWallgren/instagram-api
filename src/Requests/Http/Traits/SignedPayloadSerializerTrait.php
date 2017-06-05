<?php

namespace NicklasW\Instagram\Requests\Http\Traits;

use NicklasW\Instagram\Requests\Http\Serializers\SerializerInterface;
use NicklasW\Instagram\Requests\Support\SignatureSupport;

trait SignedPayloadSerializerTrait
{

    /**
     * The request body serializer.
     *
     * @return SerializerInterface
     */
    protected function serializer(): SerializerInterface
    {
        return new class implements SerializerInterface
        {

            /**
             * Encodes the body.
             *
             * @param string $body
             * @return null|StreamInterface|resource|string
             */
            public function encode($body)
            {
                return SignatureSupport::signature(json_encode($body));
            }
        };
    }

}