<?php

namespace Instagram\SDK\Requests\Traits;

use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\Messages\Media\CommentMessage;
use Instagram\SDK\Support\Promise;

/**
 * Trait MakeMediaRequestsAccessible
 *
 * @package Instagram\SDK\Requests\Traits
 */
trait MakeMediaRequestsAccessible
{

    /**
     * @param string $mediaId
     * @return Envelope|Promise<Envelope>
     */
    public function like(string $mediaId)
    {
        return $this->getClient()->like($mediaId);
    }

    /**
     * @param string $mediaId
     * @return Envelope|Promise<Envelope>
     */
    public function unlike(string $mediaId)
    {
        return $this->getClient()->unlike($mediaId);
    }

    /**
     * Comment a media item.
     *
     * @param string $mediaId
     * @param string $comment
     * @return CommentMessage|Promise<CommentMessage>
     */
    public function comment(string $mediaId, string $comment)
    {
        return $this->getClient()->comment($mediaId, $comment);
    }

    /**
     * Deletes a previous comment.
     *
     * @param string $mediaId
     * @param int    $commentId
     * @return Envelope|Promise<Envelope>
     */
    public function deleteComment(string $mediaId, int $commentId)
    {
        return $this->getClient()->deleteComment($mediaId, $commentId);
    }

    /**
     * Returns the client.
     *
     * @return Client
     */
    abstract protected function getClient(): Client;
}
