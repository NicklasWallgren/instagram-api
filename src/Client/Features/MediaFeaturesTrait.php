<?php

declare(strict_types=1);

namespace Instagram\SDK\Client\Features;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Exceptions\InstagramException;
use Instagram\SDK\Request\Http\Factories\PayloadSerializerFactory;
use Instagram\SDK\Request\Utils\SignatureUtils;
use Instagram\SDK\Response\Responses\Common\GeneralResponse;
use Instagram\SDK\Response\Responses\Media\CommentResponse;
use Instagram\SDK\Response\Responses\ResponseEnvelope;

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
     * @return PromiseInterface<GeneralResponse|InstagramException>
     */
    public function like(string $mediaId): PromiseInterface
    {
        return $this->authenticated(function () use ($mediaId): PromiseInterface {
            // @phan-suppress-next-line PhanPluginPrintfVariableFormatString, PhanThrowTypeAbsentForCall
            $request = $this->buildRequest(sprintf(self::$URI_LIKE, $mediaId), new GeneralResponse())
                ->addCSRFTokenAndUserId($this->session)
                ->addUuidAndUid($this->session)
                ->addPayloadParam('module_name', 'photo_view')
                ->addPayloadParam('media_id', $mediaId)
                ->setPayloadSerializerType(PayloadSerializerFactory::TYPE_SIGNED);

            return $this->call($request);
        });
    }

    /**
     * Unlike a previous liked media item.
     *
     * @param string $mediaId
     * @return PromiseInterface<GeneralResponse|InstagramException>
     */
    public function unlike(string $mediaId): PromiseInterface
    {
        return $this->authenticated(function () use ($mediaId): PromiseInterface {
            // @phan-suppress-next-line PhanPluginPrintfVariableFormatString, PhanThrowTypeAbsentForCall
            $request = $this->buildRequest(sprintf(self::$URI_UNLIKE, $mediaId), new GeneralResponse())
                ->addCSRFTokenAndUserId($this->session)
                ->addUuidAndUid($this->session)
                ->addPayloadParam('module_name', 'photo_view')
                ->addPayloadParam('media_id', $mediaId)
                ->setPayloadSerializerType(PayloadSerializerFactory::TYPE_SIGNED);

            return $this->call($request);
        });
    }

    /**
     * Comment a media item.
     *
     * @param string $mediaId
     * @param string $comment
     * @return PromiseInterface<CommentResponse|InstagramException>
     */
    public function comment(string $mediaId, string $comment): PromiseInterface
    {
        return $this->authenticated(function () use ($mediaId, $comment): PromiseInterface {
            // @phan-suppress-next-line PhanPluginPrintfVariableFormatString, PhanThrowTypeAbsentForCall
            $request = $this->buildRequest(sprintf(self::$URI_ADD_COMMENT, $mediaId), new CommentResponse())
                ->addCSRFToken($this->session)
                ->addUuidAndUid($this->session)
                ->addPayloadParam('comment_text', $comment)
                ->addPayloadParam('idempotence_token', SignatureUtils::uuid())
                ->setPayloadSerializerType(PayloadSerializerFactory::TYPE_SIGNED);

            return $this->call($request);
        });
    }

    /**
     * Delete a previous comment.
     *
     * @param string $mediaId
     * @param int    $commentId
     * @return PromiseInterface<GeneralResponse|InstagramException>
     */
    public function deleteComment(string $mediaId, int $commentId): PromiseInterface
    {
        return $this->authenticated(function () use ($mediaId, $commentId): PromiseInterface {
            // @phan-suppress-next-line PhanPluginPrintfVariableFormatString, PhanThrowTypeAbsentForCall
            $request = $this->buildRequest(sprintf(self::$URI_DELETE_COMMENT, $mediaId), new GeneralResponse())
                ->addCSRFToken($this->session)
                ->addUuidAndUid($this->session)
                ->addPayloadParam('comment_ids_to_delete', (string)$commentId)
                ->setPayloadSerializerType(PayloadSerializerFactory::TYPE_SIGNED);

            return $this->call($request);
        });
    }
}
