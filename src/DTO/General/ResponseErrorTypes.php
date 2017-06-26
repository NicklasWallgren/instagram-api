<?php

namespace NicklasW\Instagram\DTO\General;

class ResponseErrorTypes
{
    /**
     * @var string The bad password error type
     */
    const BAD_PASSWORD = 'bad_password';

    /**
     * @var string The request rate limit error type
     */
    const RATE_LIMIT = 'rate_limit_error';

    /**
     * @var string The invalid user error type
     */
    const INVALID_USER = 'invalid_user';
}
