<?php

namespace Instagram\SDK\Requests\Http\Traits;

use Instagram\SDK\Requests\Http\Serializers\SerializerInterface;
use Instagram\SDK\Requests\Traits\RequestBuilderMethodsTrait;

trait RequestBuilderBodyMethodsTrait
{

    use RequestBuilderMethodsTrait;

    /**
     * Returns the payload.
     *
     * @return string|null
     */
    protected function getBody(): ?string
    {
        return $this->serializer()->encode($this->getBodyParameters());
    }

    /**
     * Returns the body parameters.
     *
     * @return array
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
