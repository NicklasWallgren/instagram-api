<?php

namespace Instagram\SDK\Client\Features;

use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\Requests\GenericRequest;
use Instagram\SDK\Requests\Http\Builders\GenericRequestBuilder;
use Instagram\SDK\Support\Promise;
use function Instagram\SDK\Support\Promises\task;
use function Instagram\SDK\Support\request;

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
     */
    public function comment(string $mediaId, string $comment)
    {


    }

    /**
     * Deletes a previous comment.
     *
     * @param string $mediaId
     * @param string $commentId
     * @return mixed
     */
    public function deleteComment(string $mediaId, string $commentId)
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
                ->setPost('comment_ids_to_delete', $commentId)
                ->setMode(GenericRequestBuilder::$MODE_SIGNED);

            // Invoke the request
            return $request->fire();
        })($this->getMode());
    }

}
