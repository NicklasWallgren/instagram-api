<?php

namespace Instagram\SDK\DTO\Messages;

use Instagram\SDK\DTO\CsrfToken;
use Instagram\SDK\DTO\Envelope;

/**
 * Class HeaderMessage
 *
 * @package Instagram\SDK\DTO\Messages
 */
final class HeaderMessage extends Envelope
{

    /**
     * @var CsrfToken
     */
    private $token;

    /**
     * @return CsrfToken
     */
    public function getToken(): CsrfToken
    {
        return $this->token;
    }

    /**
     * @param CsrfToken $token
     * @return static
     */
    public function setToken(CsrfToken $token)
    {
        $this->token = $token;

        return $this;
    }
}
