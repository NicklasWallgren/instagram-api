<?php

declare(strict_types=1);

namespace Instagram\SDK\Client\Features;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\Messages\Media\CommentMessage;
use Instagram\SDK\Requests\GenericRequest;
use Instagram\SDK\Requests\Http\Factories\SerializerFactory;
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
     * @return PromiseInterface<Envelope>
     */
    public function like(string $mediaId): PromiseInterface
    {
        return task(function () use ($mediaId): PromiseInterface {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            /** @var GenericRequest $request */
            // @phan-suppress-next-line PhanPluginPrintfVariableFormatString
            $request = request(sprintf(self::$URI_LIKE, $mediaId), new Envelope())(
                $this,
                $this->session,
                $this->client
            );

            // Prepare the request payload
            $request
                ->addCSRFTokenAndUserId()
                ->addUuidAndUid()
                ->addPayloadParam('module_name', 'photo_view')
                ->addPayloadParam('media_id', $mediaId)
                ->setSerializerType(SerializerFactory::TYPE_SIGNED);

            return $request->fire();
        });
    }

    /**
     * Unlike a previous liked media item.
     *
     * @param string $mediaId
     * @return PromiseInterface<Envelope>
     */
    public function unlike(string $mediaId): PromiseInterface
    {
        return task(function () use ($mediaId): PromiseInterface {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            /** @var GenericRequest $request */
            // @phan-suppress-next-line PhanPluginPrintfVariableFormatString
            $request = request(sprintf(self::$URI_UNLIKE, $mediaId), new Envelope())(
                $this,
                $this->session,
                $this->client
            );

            // Prepare the request payload
            $request
                ->addCSRFTokenAndUserId()
                ->addUuidAndUid()
                ->addPayloadParam('module_name', 'photo_view')
                ->addPayloadParam('media_id', $mediaId)
                ->setSerializerType(SerializerFactory::TYPE_SIGNED);

            return $request->fire();
        });
    }

    /**
     * Comment a media item.
     *
     * @param string $mediaId
     * @param string $comment
     * @return PromiseInterface<CommentMessage>
     */
    public function comment(string $mediaId, string $comment): PromiseInterface
    {
        return task(function () use ($mediaId, $comment): PromiseInterface {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            /** @var GenericRequest $request */
            // @phan-suppress-next-line PhanPluginPrintfVariableFormatString
            $request = request(sprintf(self::$URI_ADD_COMMENT, $mediaId), new CommentMessage())(
                $this,
                $this->session,
                $this->client
            );

            // Prepare the request payload
            $request
                ->addCSRFToken()
                ->addUuidAndUid()
                ->addPayloadParam('comment_text', $comment)
                ->addPayloadParam('idempotence_token', uuid())
                ->setSerializerType(SerializerFactory::TYPE_SIGNED);

            return $request->fire();
        });
    }

    /**
     * Deletes a previous comment.
     *
     * @param string $mediaId
     * @param int    $commentId
     * @return PromiseInterface<Envelope>
     */
    public function deleteComment(string $mediaId, int $commentId): PromiseInterface
    {
        return task(function () use ($mediaId, $commentId): PromiseInterface {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            /** @var GenericRequest $request */
            // @phan-suppress-next-line PhanPluginPrintfVariableFormatString
            $request = request(sprintf(self::$URI_DELETE_COMMENT, $mediaId), new Envelope())(
                $this,
                $this->session,
                $this->client
            );

            // Prepare the request payload
            $request
                ->addCSRFToken()
                ->addUuidAndUid()
                ->addPayloadParam('comment_ids_to_delete', (string)$commentId)
                ->setSerializerType(SerializerFactory::TYPE_SIGNED);

            return $request->fire();
        });
    }
}
