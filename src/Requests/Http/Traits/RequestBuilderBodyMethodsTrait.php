<?php

namespace Instagram\SDK\Requests\Http\Traits;

use Instagram\SDK\Requests\Exceptions\EncodingException;
use Instagram\SDK\Requests\Http\Serializers\SerializerInterface;
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
     * @return SerializerInterface
     */
    abstract protected function serializer(): SerializerInterface;
}
