<?php

namespace Instagram\SDK\DTO\Messages\Feed;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\Responses\Interfaces\IteratorInterface;
use Tebru\Gson\Annotation\SerializedName;
use function GuzzleHttp\Promise\rejection_for;

/**
 * Class Timeline
 *
 * @package            Instagram\SDK\DTO\Messages\Feed
 * @phan-file-suppress PhanUnextractableAnnotation
 * @phan-file-suppress PhanPluginUnknownPropertyType
 */
final class TimelineMessage extends Envelope implements IteratorInterface
{

    /**
     * @var int
     * @SerializedName("num_results")
     */
    private $numberOfResults;

    /**
     * @var bool
     */
    private $moreAvailable;

    /**
     * @var bool
     */
    private $autoLoadMoreEnabled;

    /**
     * @var array<\stdClass> // TODO, define DTO class
     */
    private $feedItems;

    /**
     * @var string
     */
    private $nextMaxId;

    /**
     * @var
     */
    private $paginationInfo;

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
     * @return mixed
     */
    public function next()
    {
        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return $this->nextPromise()->wait();
    }

    /**
     * @return PromiseInterface
     */
    public function nextPromise(): PromiseInterface
    {
        return rejection_for('not implemented yet.');
    }

    /**
     * @return mixed
     */
    public function rewind()
    {
        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return $this->rewindPromise()->wait();
    }

    /**
     * @return PromiseInterface
     */
    public function rewindPromise(): PromiseInterface
    {
        return rejection_for('not implemented yet.');
    }
}
