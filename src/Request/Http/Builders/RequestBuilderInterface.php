<?php

declare(strict_types=1);

namespace Instagram\SDK\Request\Http\Builders;

use GuzzleHttp\Psr7\Request;

/**
 * Interface RequestBuilderInterface
 *
 * @package            Instagram\SDK\Request\Http\Builders
 * @phan-file-suppress PhanPluginNoCommentOnPublicMethod
 */
interface RequestBuilderInterface
{
    public function build(): Request;
}
