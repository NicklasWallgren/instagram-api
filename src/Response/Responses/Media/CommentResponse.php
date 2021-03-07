<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Responses\Media;

use Instagram\SDK\Response\DTO\Media\Comment;
use Instagram\SDK\Response\Responses\ResponseEnvelope;

/**
 * Class CommentMessage
 *
 * @package Instagram\SDK\Response\Responses\Media
 */
final class CommentResponse extends ResponseEnvelope
{

    /** @var Comment */
    private $comment;

    /**
     * @return Comment
     */
    public function getComment(): Comment
    {
        return $this->comment;
    }
}
