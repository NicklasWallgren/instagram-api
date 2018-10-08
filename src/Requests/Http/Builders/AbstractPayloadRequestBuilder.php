<?php

namespace Instagram\SDK\Requests\Http\Builders;

use Instagram\SDK\Requests\Http\Traits\RequestBuilderBodyMethodsTrait;

/**
 * Class AbstractPayloadRequestBuilder
 *
 * @package Instagram\SDK\Requests\Http\Builders
 */
abstract class AbstractPayloadRequestBuilder extends AbstractRequestBuilder
{

    use RequestBuilderBodyMethodsTrait;
}
