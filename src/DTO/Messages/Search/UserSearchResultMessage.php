<?php

namespace Instagram\SDK\DTO\Messages\Search;

use Instagram\SDK\DTO\General\User;

/**
 * Class UserSearchResultMessage
 *
 * @package Instagram\SDK\DTO\Messages\Search
 */
final class UserSearchResultMessage extends SearchResultMessage
{

    /**
     * @var int
     */
    private $numResults;

    /**
     * @var User[]
     */
    private $users;

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
