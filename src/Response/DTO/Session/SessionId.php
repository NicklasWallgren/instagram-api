<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\DTO\Session;

/**
 * Class SessionId
 *
 * @package Instagram\SDK\Payloads\Session
 */
final class SessionId
{

    /**
     * @var string
     */
    private $id;

    /**
     * SessionId constructor.
     *
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
