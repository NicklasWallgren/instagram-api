<?php

namespace Instagram\SDK\DTO;

class CsrfToken
{

    /**
     * @var string
     */
    private $token;

    /**
     * CsrfTokenDTO constructor.
     *
     * @param string $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Returns the CSRF token.
     *
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }
}
