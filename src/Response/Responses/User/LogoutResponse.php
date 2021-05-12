<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Responses\User;

use Instagram\SDK\Response\Responses\ResponseEnvelope;

/**
 * Class LogoutResponse
 *
 * @package Instagram\SDK\Response\Responses\User
 */
final class LogoutResponse extends ResponseEnvelope
{

    /** @var string */
    private $loginNonce;

    /**
     * @return string
     */
    public function getLoginNonce(): string
    {
        return $this->loginNonce;
    }
}
