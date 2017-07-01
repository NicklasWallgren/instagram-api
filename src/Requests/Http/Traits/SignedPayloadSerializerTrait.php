<?php

namespace Instagram\SDK\Requests\Http\Traits;

use Instagram\SDK\Requests\Http\Serializers\SerializerInterface;
use Instagram\SDK\Requests\Support\SignatureSupport;

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
