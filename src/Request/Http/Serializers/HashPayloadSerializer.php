<?php

declare(strict_types=1);

namespace Instagram\SDK\Request\Http\Serializers;

use Instagram\SDK\Exceptions\EncodingException;
use Instagram\SDK\Request\Utils\SignatureUtils;

/**
 * Class HashSerializer
 *
 * @package Instagram\SDK\Request\Http\Serializers
 */
class HashPayloadSerializer implements PayloadSerializerInterface
{

    /**
     * @inheritdoc
     * @param array<string, mixed> $payload
     */
    public function encode(array $payload): string
    {
        if (($data = json_encode($payload)) === false) {
            throw new EncodingException(json_last_error_msg());
        }

        return SignatureUtils::signature($data);
    }
}
