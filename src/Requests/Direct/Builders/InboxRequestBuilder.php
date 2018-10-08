<?php

namespace Instagram\SDK\Requests\Direct\Builders;

use Instagram\SDK\Requests\Http\Builders\AbstractQueryRequestBuilder;

/**
 * Class InboxRequestBuilder
 *
 * @package Instagram\SDK\Requests\Direct\Builders
 */
class InboxRequestBuilder extends AbstractQueryRequestBuilder
{

    /**
     * @var string The inbox request uri
     */
    protected static $REQUEST_URI = 'direct_v2/inbox/';
}
