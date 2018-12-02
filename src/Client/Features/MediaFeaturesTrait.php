<?php

namespace Instagram\SDK\Client\Features;

use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\Messages\Media\CommentMessage;
use Instagram\SDK\Requests\GenericRequest;
use Instagram\SDK\Requests\Http\Builders\GenericRequestBuilder;
use Instagram\SDK\Support\Promise;
use function Instagram\SDK\Support\Promises\task;
use function Instagram\SDK\Support\request;
use function Instagram\SDK\Support\uuid;

/**
 * Trait MediaFeaturesTrait
 *
 * @package            Instagram\SDK\Client\Features
 * @phan-file-suppress PhanUnreferencedUseNormal
 */
trait MediaFeaturesTrait
{

    use DefaultFeaturesTrait;

    /**
     * @var string
     */
    private static $URI_LIKE = 'media/%s/like/';

    /**
     * @var string
     */
    private static $URI_UNLIKE = 'media/%s/unlike/';

    /**
     * @var string
     */
    private static $URI_ADD_COMMENT = 'media/%s/comment/';

    /**
     * @var string
     */
    private static $URI_DELETE_COMMENT = 'media/%s/comment/bulk_delete/';

    /**
     * Likes a media item.
     *
     * @param string $mediaId
     * @return Envelope|Promise<Envelope>
     */
    public function like(string $mediaId)
    {
        return task(function () use ($mediaId): Promise {
            $this->checkPrerequisites();

            /**
             * @var GenericRequest $request
             */
            $request = request(sprintf(self::$URI_LIKE, $mediaId), new Envelope())(
                $this,
                $this->session,
                $this->client
            );

            // Prepare the request payload
            $request
                ->addCSRFTokenAndUserId()
                ->addUuidAndUid()
                ->setPost('module_name', 'photo_view')
                ->setPost('media_id', $mediaId)
                ->setMode(GenericRequestBuilder::$MODE_SIGNED);

            // Invoke the request
            return $request->fire();
        })($this->getMode());
    }

    /**
     * Unlike a previous liked media item.
     *
     * @param string $mediaId
     * @return Envelope|Promise<Envelope>
     */
    public function unlike(string $mediaId)
    {
        return task(function () use ($mediaId): Promise {
            $this->checkPrerequisites();

            /**
             * @var GenericRequest $request
             */
            $request = request(sprintf(self::$URI_UNLIKE, $mediaId), new Envelope())(
                $this,
                $this->session,
                $this->client
            );

            // Prepare the request payload
            $request
                ->addCSRFTokenAndUserId()
                ->addUuidAndUid()
                ->setPost('module_name', 'photo_view')
                ->setPost('media_id', $mediaId)
                ->setMode(GenericRequestBuilder::$MODE_SIGNED);

            // Invoke the request
            return $request->fire();
        })($this->getMode());
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
        return task(function () use ($mediaId, $comment): Promise {
            $this->checkPrerequisites();

            /**
             * @var GenericRequest $request
             */
            $request = request(sprintf(self::$URI_ADD_COMMENT, $mediaId), new CommentMessage())(
                $this,
                $this->session,
                $this->client
            );

            // Prepare the request payload
            $request
                ->addCSRFToken()
                ->addUuidAndUid()
                ->setPost('comment_text', $comment)
                ->setPost('idempotence_token', uuid())
                ->setMode(GenericRequestBuilder::$MODE_SIGNED);

            // Invoke the request
            return $request->fire();
        })($this->getMode());
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
        return task(function () use ($mediaId, $commentId): Promise {
            $this->checkPrerequisites();

            /**
             * @var GenericRequest $request
             */
            $request = request(sprintf(self::$URI_DELETE_COMMENT, $mediaId), new Envelope())(
                $this,
                $this->session,
                $this->client
            );

            // Prepare the request payload
            $request
                ->addCSRFToken()
                ->addUuidAndUid()
                ->setPost('comment_ids_to_delete', (string)$commentId)
                ->setMode(GenericRequestBuilder::$MODE_SIGNED);

            // Invoke the request
            return $request->fire();
        })($this->getMode());
    }
}
