<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\DTO;

/**
 * Class CsrfToken
 *
 * @package Instagram\SDK\Payloads
 */
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
    public function __construct(string $token)
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
