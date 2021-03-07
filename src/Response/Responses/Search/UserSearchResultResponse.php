<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Responses\Search;

use Instagram\SDK\Response\DTO\General\User;

/**
 * Class UserSearchResultMessage
 *
 * @package Instagram\SDK\Response\Responses\Search
 */
final class UserSearchResultResponse extends SearchResultResponse
{

    /** @var User[] */
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
