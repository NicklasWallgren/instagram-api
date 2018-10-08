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
class HashSerializer implements SerializerInterface
{

    /**
     * Encodes the body.
     *
     * @param array $body
     * @return string
     * @throws Exception
     */
    public function encode($body): string
    {
        Assert::isArray($body);

        if (($data = json_encode($body)) === false) {
            throw new EncodingException(json_last_error_msg());
        }

        return SignatureSupport::signature($data);
    }
}
