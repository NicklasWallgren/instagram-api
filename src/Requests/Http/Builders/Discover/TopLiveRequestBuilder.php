<?php

namespace NicklasW\Instagram\Requests\Http\Builders\Discover;

use NicklasW\Instagram\Requests\Http\Builders\AbstractQueryRequestBuilder;

class TopLiveRequestBuilder extends AbstractQueryRequestBuilder
{

    /**
     * @var string The discover top live request uri
     */
    protected static $REQUEST_URI = 'discover/top_live/';

}