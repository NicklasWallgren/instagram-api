<?php

namespace NicklasW\Instagram\Requests\Discover\Builders;

use NicklasW\Instagram\Requests\Http\Builders\AbstractQueryRequestBuilder;

class ChannelsRequestBuilder extends AbstractQueryRequestBuilder
{

    /**
     * @var string The discover channels home request uri
     */
    protected static $REQUEST_URI = 'discover/channels_home/';
}
