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

}
