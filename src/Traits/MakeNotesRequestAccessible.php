<?php

declare(strict_types=1);

namespace Instagram\SDK\Traits;

use Instagram\SDK\Client\Client;
use Instagram\SDK\Exceptions\InstagramException;
use Instagram\SDK\Response\Responses\Common\GeneralResponse;
use Instagram\SDK\Response\Responses\Notes\NotesResponse;
use Instagram\SDK\Utils\PromiseUtils;

/**
 * Trait MakeNotesRequestAccessible
 *
 * @package Instagram\SDK\Traits
 */
trait MakeNotesRequestAccessible
{
    /**
     * Retrieve notes.
     *
     * @return NotesResponse
     * @throws InstagramException in case of an error
     */
    public function notes(): NotesResponse
    {
        return PromiseUtils::wait($this->getClient()->notes());
    }

    /**
     * Create a note.
     *
     * @param string $text
     * @param int $audience
     * @return GeneralResponse
     * @throws InstagramException in case of an error
     */
    public function createNote(string $text, int $audience = 0): GeneralResponse
    {
        return PromiseUtils::wait($this->getClient()->createNote($text, $audience));
    }

    /**
     * Returns the client.
     *
     * @return Client
     */
    abstract protected function getClient(): Client;
}
