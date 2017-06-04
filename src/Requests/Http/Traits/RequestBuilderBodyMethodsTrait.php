<?php

namespace NicklasW\Instagram\Requests\Http\Traits;

use NicklasW\Instagram\Requests\Http\Marshallers\SerializerInterface;
use NicklasW\Instagram\Requests\Traits\RequestBuilderMethodsTrait;

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