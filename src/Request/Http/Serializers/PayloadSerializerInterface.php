<?php

declare(strict_types=1);

namespace Instagram\SDK\Request\Http\Serializers;

use Instagram\SDK\Exceptions\EncodingException;

/**
 * Interface PayloadSerializerInterface
 *
 * @package Instagram\SDK\Request\Http\Serializers
 */
interface PayloadSerializerInterface
{

    /**
     * Encodes the body.
     *
     * @param array<string, mixed> $payload
     * @return string
     * @throws EncodingException
     */
    public function encode(array $payload): string;
}
