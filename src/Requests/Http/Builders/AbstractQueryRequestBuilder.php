<?php

namespace Instagram\SDK\Requests\Http\Builders;

use Instagram\SDK\Requests\Http\Traits\RequestBuilderQueryMethodsTrait;

abstract class AbstractQueryRequestBuilder extends AbstractRequestBuilder
{

    use RequestBuilderQueryMethodsTrait;

    /**
     * @var string The inbox request uri
     */
    protected static $REQUEST_URI = null;

    /**
     * @var string The uri template
     */
    protected static $URI_TEMPLATE = null;

    /**
     * Returns the payload.
     *
     * @return string|null
     */
    protected function getBody(): ?string
    {
        return null;
    }
}
