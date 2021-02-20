<?php

namespace Instagram\SDK\Requests\Http\Traits;

use Instagram\SDK\Requests\Exceptions\EncodingException;
use Instagram\SDK\Requests\Http\Serializers\PayloadSerializerInterface;
use Instagram\SDK\Requests\Utils\SignatureUtils;

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
     * @return PayloadSerializerInterface
     */
    protected function serializer(): PayloadSerializerInterface
    {
        return new class implements PayloadSerializerInterface
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

                return SignatureUtils::signature($data);
            }
        };
    }
}
