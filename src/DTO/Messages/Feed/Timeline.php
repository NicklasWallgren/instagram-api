<?php

namespace Instagram\SDK\DTO\Messages\Feed;

use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\Interfaces\PropertiesInterface;
use Instagram\SDK\DTO\Traits\Inflatable;
use Instagram\SDK\Responses\Interfaces\IteratorInterface;

/**
 * Class Timeline
 *
 * @package Instagram\SDK\DTO\Messages\Feed
 * @phan-file-suppress PhanUnextractableAnnotation
 * @phan-file-suppress PhanPluginUnknownPropertyType
 */
class Timeline extends Envelope implements IteratorInterface, PropertiesInterface
{

    use Inflatable;

    /**
     * @var int
     * @name num_results
     */
    protected $numberOfResults;

    /**
     * @var bool
     * @name more_available
     */
    protected $moreAvailable;

    /**
     * @var bool
     * @name auto_load_more_enabled
     */
    protected $autoLoadMoreEnabled;

    /**
     * @var array
     * @name feed_items
     */
    protected $feedItems;

    /**
     * @var string
     * @name next_max_id
     */
    protected $nextMaxId;

    /**
     * @var
     * @name pagination_info
     */
    protected $paginationInfo;

    /**
     * @return mixed
     */
    public function getNumberOfResults()
    {
        return $this->numberOfResults;
    }

    /**
     * @return mixed
     */
    public function getMoreAvailable()
    {
        return $this->moreAvailable;
    }

    /**
     * @return mixed
     */
    public function getAutoLoadMoreEnabled()
    {
        return $this->autoLoadMoreEnabled;
    }

    /**
     * @return mixed
     */
    public function getFeedItems()
    {
        return $this->feedItems;
    }

    /**
     * @return mixed
     */
    public function getNextMaxId()
    {
        return $this->nextMaxId;
    }

    /**
     * @return mixed
     */
    public function getPaginationInfo()
    {
        return $this->paginationInfo;
    }

    /**
     * @return bool
     */
    public function next()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function rewind()
    {
        return false;
    }
}
