<?php

namespace Instagram\SDK\Requests\Http\Serializers;

use Instagram\SDK\Requests\Support\SignatureSupport;

class HashSerializer implements SerializerInterface
{

    /**
     * Encodes the body.
     *
     * @param array $body
     * @return string
     */
    public function encode($body): string
    {
        return SignatureSupport::signature(json_encode($body));
    }
}
