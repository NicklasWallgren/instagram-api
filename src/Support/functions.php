<?php

namespace NicklasW\Instagram\Support;

use GuzzleHttp\Promise\Promise;
use NicklasW\Instagram\Requests\Support\SignatureSupport;

/**
 * Generates a universal unique identifier.
 *
 * @param bool $type The identifier type
 * @return string
 */
function uuid(bool $type = SignatureSupport::TYPE_DEFAULT): string
{
    return SignatureSupport::uuid($type);
}

/**
 * Unwrap promise.
 *
 * @param Promise|mixed $value
 * @return mixed
 */
function unwrap($value)
{
    return $value instanceof Promise? $value->wait() : $value;
}
