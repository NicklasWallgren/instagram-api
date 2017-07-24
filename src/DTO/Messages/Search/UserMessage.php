<?php

namespace Instagram\SDK\DTO\Messages\Search;

use Instagram\SDK\DTO\General\User;

class UserMessage extends SearchResultMessage
{

    /**
     * @var int
     */
    protected $numResults;

    /**
     * @var \Instagram\SDK\DTO\General\User[]
     */
    protected $users;

    /**
     * @return int
     */
    public function getNumResults(): int
    {
        return $this->numResults;
    }

    /**
     * @return User[]
     */
    public function getUsers(): array
    {
        return $this->users;
    }
}
