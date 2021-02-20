<?php

namespace Instagram\SDK\DTO\Messages\User;

use Instagram\SDK\DTO\Envelope;

/**
 * Class LogoutMessage
 *
 * @package Instagram\SDK\DTO\Messages\User
 */
final class LogoutMessage extends Envelope
{

    /**
     * @var string
     */
    private $loginNonce;

    /**
     * @return mixed
     */
    public function getLoginNonce()
    {
        return $this->loginNonce;
    }
}
