<?php

namespace Instagram\SDK\Requests\Http\Serializers;

use Instagram\SDK\Requests\Exceptions\EncodingException;

/**
 * Interface SerializerInterface
 *
 * @package Instagram\SDK\Requests\Http\Serializers
 */
interface SerializerInterface
{

    /**
     * Encodes the body.
     *
     * @param mixed $body
     * @return string
     * @throws EncodingException
     */
    public function encode($body);
}
