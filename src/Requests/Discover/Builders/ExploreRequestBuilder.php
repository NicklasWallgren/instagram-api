<?php

namespace Instagram\SDK\Requests\Discover\Builders;

use Instagram\SDK\Requests\Http\Builders\AbstractQueryRequestBuilder;

class ExploreRequestBuilder extends AbstractQueryRequestBuilder
{

    /**
     * @var string The discover request uri
     */
    protected static $REQUEST_URI = 'discover/explore/';
}
