<?php

namespace Instagram\SDK\DTO\Hashtag;

use Exception;
use Instagram\SDK\Client\Client;
use Instagram\SDK\Responses\Serializers\Interfaces\OnItemDecodeInterface;
use Instagram\SDK\Responses\Serializers\Traits\OnPropagateDecodeEventTrait;

/**
 * Class Item
 *
 * @package Instagram\SDK\DTO\Hashtag
 */
class Item implements OnItemDecodeInterface
{

    use OnPropagateDecodeEventTrait;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var int
     * @name taken_at
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
     * @name device_timestamp
     */
    protected $deviceTimestamp;

    /**
     * @var int
     * @name media_type
     */
    protected $mediaType;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     * @name client_cache_key
     */
    protected $clientCacheKey;

    /**
     * @var int
     * @name filter_type
     */
    protected $filterType;

    /**
     * @var \Instagram\SDK\DTO\General\Media\ImageVersions2[]
     * @name image_versions2
     */
    protected $imageVersions2;

    /**
     * @var float
     * @name original_width
     */
    protected $originalWidth;

    /**
     * @var float
     * @name original_height
     */
    protected $originalHeight;

    /**
     * @var object
     */
    protected $videoVersions;

    /**
     * @var bool
     * @name has_audio
     */
    protected $hasAudio;

    /**
     * @var int
     * @name video_duration
     */
    protected $videoDuration;

    /**
     * @var int
     * @name view_count
     */
    protected $viewCount;

    /**
     * @var object
     * TODO
     */
    protected $user;

    /**
     * @var object
     * TODO
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
     * @name has_liked
     */
    protected $has_liked;

    /**
     * @var bool
     * @name comment_likes_enabled
     */
    protected $commentLikesEnabled;

    /**
     * @var bool
     * @name comment_threading_enabled
     */
    protected $commentThreadingEnabled;

    /**
     * @var bool
     * @name has_more_comments
     */
    protected $hasMoreComments;

    /**
     * @var float
     * @name next_max_id
     */
    protected $nextMaxId;

    /**
     * @var int
     * @name max_num_visible_preview_comments
     */
    protected $maxNumVisiblePreviewComments;

    /**
     * @var int
     * @name comment_count
     */
    protected $commentCount;

    /**
     * @var bool
     * @name photo_of_you
     */
    protected $photoOfYou;

    /**
     * @var bool
     * @name can_viewer_save
     */
    protected $canViewerSave;

    /**
     * @var string
     * @name organic_tracking_token
     */
    protected $organicTrackingToken;

    /**
     * On item decode method.
     *
     * @suppress PhanUnusedPublicMethodParameter
     * @suppress PhanPossiblyNullTypeMismatchProperty
     * @param array<string, mixed> $container
     * @param array<string, string> $requirements
     * @throws Exception
     */
    public function onDecode(array $container, $requirements = []): void
    {
        $this->client = $container['client'];

        $this->propagate($container);
    }
}
