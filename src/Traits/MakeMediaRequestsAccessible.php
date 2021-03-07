<?php

declare(strict_types=1);

namespace Instagram\SDK\Traits;

use Instagram\SDK\Client\Client;
use Instagram\SDK\Exceptions\InstagramException;
use Instagram\SDK\Response\Responses\Common\GeneralResponse;
use Instagram\SDK\Response\Responses\Media\CommentResponse;
use Instagram\SDK\Utils\PromiseUtils;

/**
 * Trait MakeMediaRequestsAccessible
 *
 * @package Instagram\SDK\Traits
 */
trait MakeMediaRequestsAccessible
{

    /**
     * Like a media item by id.
     *
     * @param string $mediaId
     * @return GeneralResponse
     * @throws InstagramException in case of an error
     */
    public function like(string $mediaId): GeneralResponse
    {
        return PromiseUtils::wait($this->getClient()->like($mediaId));
    }

    /**
     * Unlike a media item by id.
     *
     * @param string $mediaId
     * @return GeneralResponse
     * @throws InstagramException in case of an error
     */
    public function unlike(string $mediaId): GeneralResponse
    {
        return PromiseUtils::wait($this->getClient()->unlike($mediaId));
    }

    /**
     * Comment a media item.
     *
     * @param string $mediaId
     * @param string $comment
     * @return CommentResponse
     * @throws InstagramException in case of an error
     */
    public function comment(string $mediaId, string $comment): CommentResponse
    {
        return PromiseUtils::wait($this->getClient()->comment($mediaId, $comment));
    }

    /**
     * Delete a previous comment.
     *
     * @param string $mediaId
     * @param int    $commentId
     * @return GeneralResponse
     * @throws InstagramException in case of an error
     */
    public function deleteComment(string $mediaId, int $commentId): GeneralResponse
    {
        return PromiseUtils::wait($this->getClient()->deleteComment($mediaId, $commentId));
    }

    /**
     * Returns the client.
     *
     * @return Client
     */
    abstract protected function getClient(): Client;
}
