<?php

namespace Instagram\SDK\DTO\Messages\User;

use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\Responses\Serializers\Traits\OnPropagateDecodeEventTrait;

/**
 * Class LogoutMessage
 *
 * @package Instagram\SDK\DTO\Messages\User
 */
class LogoutMessage extends Envelope
{

    use OnPropagateDecodeEventTrait;

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
