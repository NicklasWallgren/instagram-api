<?php

namespace Instagram\SDK\Requests\Http\Builders;

use GuzzleHttp\Psr7\Request;

/**
 * Interface RequestBuilderInterface
 *
 * @package Instagram\SDK\Requests\Http\Builders
 * @phan-file-suppress PhanPluginNoCommentOnPublicMethod
 */
interface RequestBuilderInterface
{

    public function build(): Request;
}
