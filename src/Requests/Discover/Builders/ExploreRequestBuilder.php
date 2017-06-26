<?php

namespace NicklasW\Instagram\Requests\Discover\Builders;

use NicklasW\Instagram\Requests\Http\Builders\AbstractQueryRequestBuilder;

class ExploreRequestBuilder extends AbstractQueryRequestBuilder
{

    /**
     * @var string The discover request uri
     */
    protected static $REQUEST_URI = 'discover/explore/';
}
