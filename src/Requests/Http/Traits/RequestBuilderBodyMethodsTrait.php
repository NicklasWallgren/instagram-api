<?php

namespace Instagram\SDK\Requests\Http\Traits;

use Instagram\SDK\Requests\Exceptions\EncodingException;
use Instagram\SDK\Requests\Http\Serializers\PayloadSerializerInterface;
use Instagram\SDK\Requests\Traits\RequestBuilderMethodsTrait;

/**
 * Trait RequestBuilderBodyMethodsTrait
 *
 * @package Instagram\SDK\Requests\Http\Traits
 */
trait RequestBuilderBodyMethodsTrait
{

    use RequestBuilderMethodsTrait;

    /**
     * Returns the payload.
     *
     * @return string|null
     * @throws EncodingException
     */
    protected function getBody(): ?string
    {
        return $this->serializer()->encode($this->getBodyParameters());
    }

    /**
     * Returns the body parameters.
     *
     * @return array<string, mixed>
     */
    protected function getBodyParameters(): array
    {
        return [];
    }

    /**
     * Returns the body serializer.
     *
     * @return PayloadSerializerInterface
     */
    abstract protected function serializer(): PayloadSerializerInterface;
}
