<?php

namespace NicklasW\Instagram\DTO\Messages;

use NicklasW\Instagram\DTO\CsrfToken;
use NicklasW\Instagram\DTO\Envelope;

class HeaderMessage extends Envelope
{

    /**
     * @var CsrfToken
     */
    protected $token;

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