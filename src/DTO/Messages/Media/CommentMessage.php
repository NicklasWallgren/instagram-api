<?php

namespace Instagram\SDK\DTO\Messages\Media;

use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\Media\Comment;

/**
 * Class CommentMessage
 *
 * @package Instagram\SDK\DTO\Messages\Media
 */
class CommentMessage extends Envelope
{

    /**
     * @var \Instagram\SDK\DTO\Media\Comment
     */
    protected $comment;

    /**
     * @return Comment
     */
    public function getComment(): Comment
    {
        return $this->comment;
    }
}
