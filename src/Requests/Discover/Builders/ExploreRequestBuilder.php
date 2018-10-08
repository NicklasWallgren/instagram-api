<?php

namespace Instagram\SDK\Requests\Discover\Builders;

use Instagram\SDK\Requests\Http\Builders\AbstractQueryRequestBuilder;

/**
 * Class ExploreRequestBuilder
 *
 * @package Instagram\SDK\Requests\Discover\Builders
 */
class ExploreRequestBuilder extends AbstractQueryRequestBuilder
{

    /**
     * @var string The discover request uri
     */
    protected static $REQUEST_URI = 'discover/explore/';
}
