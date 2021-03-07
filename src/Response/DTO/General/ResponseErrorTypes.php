<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\DTO\General;

/**
 * Class ResponseErrorTypes
 *
 * @package Instagram\SDK\Payloads\General
 */
final class ResponseErrorTypes
{
    const BAD_PASSWORD = 'bad_password';
    const RATE_LIMIT = 'rate_limit_error';
    const INVALID_USER = 'invalid_user';
}
