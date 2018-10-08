<?php

namespace Instagram\SDK\DTO\Session;

/**
 * Class SessionId
 *
 * @package Instagram\SDK\DTO\Session
 */
class SessionId
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
    public function __construct($id)
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
