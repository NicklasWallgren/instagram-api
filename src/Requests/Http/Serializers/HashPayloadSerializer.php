<?php

namespace Instagram\SDK\Requests\Http\Serializers;

use Exception;
use Instagram\SDK\Requests\Exceptions\EncodingException;
use Instagram\SDK\Requests\Utils\SignatureUtils;
use Webmozart\Assert\Assert;

/**
 * Class HashSerializer
 *
 * @package Instagram\SDK\Requests\Http\Serializers
 */
class HashPayloadSerializer implements PayloadSerializerInterface
{

    /**
     * Encodes the body.
     *
     * @param array<string, mixed> $body
     * @return string
     * @throws Exception
     */
    public function encode(array $body): string
    {
        Assert::isArray($body);

        if (($data = json_encode($body)) === false) {
            throw new EncodingException(json_last_error_msg());
        }

        return SignatureUtils::signature($data);
    }
}
