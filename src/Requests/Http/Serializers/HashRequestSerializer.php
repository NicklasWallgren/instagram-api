<?php

namespace Instagram\SDK\Requests\Http\Serializers;

use Exception;
use Instagram\SDK\Requests\Exceptions\EncodingException;
use Instagram\SDK\Requests\Support\SignatureSupport;
use Webmozart\Assert\Assert;

/**
 * Class HashSerializer
 *
 * @package Instagram\SDK\Requests\Http\Serializers
 */
class HashRequestSerializer implements RequestSerializerInterface
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

        return SignatureSupport::signature($data);
    }
}
