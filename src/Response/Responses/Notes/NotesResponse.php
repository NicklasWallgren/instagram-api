<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Responses\Notes;

use Instagram\SDK\Response\DTO\Notes\Note;
use Instagram\SDK\Response\Responses\ResponseEnvelope;

/**
 * Class NotesResponse
 *
 * @package Instagram\SDK\Response\Responses\Notes
 */
final class NotesResponse extends ResponseEnvelope
{

    /** 
     * @var Note[]
     */ 
    private $items;

    /**
     * @return Note[]
     */
    public function getItems(): Note[]
    {
        return $this->items;
    }
}
