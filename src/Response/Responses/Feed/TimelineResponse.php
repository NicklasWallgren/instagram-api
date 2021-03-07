<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Responses\Feed;

use GuzzleHttp\Promise\Create;
use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Response\Interfaces\IteratorInterface;
use Instagram\SDK\Response\Responses\ResponseEnvelope;
use Instagram\SDK\Utils\PromiseUtils;
use Tebru\Gson\Annotation\SerializedName;

/**
 * Class Timeline
 *
 * @package            Instagram\SDK\Response\Responses\Feed
 * @phan-file-suppress PhanUnextractableAnnotation
 * @phan-file-suppress PhanPluginUnknownPropertyType
 */
final class TimelineResponse extends ResponseEnvelope implements IteratorInterface
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
     * @return bool
     */
    public function getMoreAvailable()
    {
        return $this->moreAvailable;
    }

    /**
     * @return bool
     */
    public function getAutoLoadMoreEnabled()
    {
        return $this->autoLoadMoreEnabled;
    }

    /**
     * @return \stdClass[]
     */
    public function getFeedItems()
    {
        return $this->feedItems;
    }

    /**
     * @return string
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
     * @return ResponseEnvelope|mixed|null
     */
    public function next()
    {
        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return PromiseUtils::wait($this->nextPromise());
    }

    /**
     * @return PromiseInterface
     * @phan-suppress PhanParamSignatureMismatch
     */
    public function nextPromise(): PromiseInterface
    {
        return Create::rejectionFor('not implemented yet.');
    }

    /**
     * @return mixed
     */
    public function rewind()
    {
        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return PromiseUtils::wait($this->rewindPromise());
    }

    /**
     * @return PromiseInterface
     * @phan-suppress PhanParamSignatureMismatch
     */
    public function rewindPromise(): PromiseInterface
    {
        return Create::rejectionFor('not implemented yet.'); // TODO
    }
}
