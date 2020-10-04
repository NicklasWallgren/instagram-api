<?php

namespace Instagram\SDK\Requests\Http\Traits;

use Instagram\SDK\Requests\Exceptions\EncodingException;
use Instagram\SDK\Requests\Http\Serializers\SerializerInterface;
use Instagram\SDK\Requests\Support\SignatureSupport;

/**
 * Trait SignedPayloadSerializerTrait
 *
 * @package Instagram\SDK\Requests\Http\Traits
 */
trait SignedPayloadSerializerTrait
{

    /**
     * The request body serializer.
     *
     * @suppress PhanPluginNoCommentOnClass
     * @return SerializerInterface
     */
    protected function serializer(): SerializerInterface
    {
        return new class implements SerializerInterface
        {

            /**
             * Encodes the body.
             *
             * @param array<string, mixed> $body
             * @return string
             * @throws EncodingException
             */
            public function encode(array $body)
            {
                if (($data = json_encode($body)) === false) {
                    throw new EncodingException(json_last_error_msg());
                }

                return SignatureSupport::signature($data);
            }
        };
    }
}
