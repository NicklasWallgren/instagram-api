<?php

namespace Instagram\SDK\DTO\Hashtag;

use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Traits\PropertiesTrait;
use Instagram\SDK\Responses\Serializers\Interfaces\OnItemDecodeInterface;
use Instagram\SDK\Responses\Serializers\Traits\OnPropagateDecodeEventTrait;

/**
 * Class Item
 *
 * @package Instagram\SDK\DTO\Hashtag
 */
class Item implements OnItemDecodeInterface
{

    use PropertiesTrait;
    use OnPropagateDecodeEventTrait;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var int
     */
    protected $takenAt;

    /**
     * @var float
     */
    protected $pk;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var int
     */
    protected $deviceTimestamp;

    /**
     * @var int
     */
    protected $mediaType;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $clientCacheKey;

    /**
     * @var int
     */
    protected $filterType;

    /**
     * @var object
     */
    protected $imageVersions2;

    /**
     * @var float
     */
    protected $originalWidth;

    /**
     * @var float
     */
    protected $originalHeight;

    /**
     * @var object
     */
    protected $videoVersions;

    /**
     * @var bool
     */
    protected $hasAudio;

    /**
     * @var int
     */
    protected $videoDuration;

    /**
     * @var int
     */
    protected $viewCount;

    /**
     * @var object // TODO
     */
    protected $user;

    /**
     * @var object // TODO
     */
    protected $caption;

    /**
     * @var bool
     */
    protected $captionIsEdited;

    /**
     * @var int
     */
    protected $likeCount;

    /**
     * @var bool
     */
    protected $has_liked;

    /**
     * @var bool
     */
    protected $commentLikesEnabled;

    /**
     * @var bool
     */
    protected $commentThreadingEnabled;

    /**
     * @var bool
     */
    protected $hasMoreComments;

    /**
     * @var float
     */
    protected $nextMaxId;

    /**
     * @var int
     */
    protected $maxNumVisiblePreviewComments;

    /**
     * @var int
     */
    protected $commentCount;

    /**
     * @var bool
     */
    protected $photoOfYou;

    /**
     * @var bool
     */
    protected $canViewerSave;

    /**
     * @var string
     */
    protected $organicTrackingToken;

    /**
     * On item decode method.
     *
     * @suppress PhanUnusedPublicMethodParameter
     * @suppress PhanPossiblyNullTypeMismatchProperty
     * @param array<string, mixed> $container
     */
    public function onDecode(array $container): void
    {
        $this->client = $container['client'];

        $this->propagate($container);
    }
}
