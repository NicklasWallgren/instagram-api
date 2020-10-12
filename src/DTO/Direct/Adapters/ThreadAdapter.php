<?php

namespace Instagram\SDK\DTO\Direct\Adapters;

use Instagram\SDK\DTO\Direct\Thread;
use Instagram\SDK\DTO\Direct\ThreadItem;
use Tebru\Gson\Context\ReaderContext;
use Tebru\Gson\Context\WriterContext;
use Tebru\Gson\Internal\AccessorStrategy\SetByClosure;
use Tebru\Gson\TypeAdapter;

/**
 * Class ThreadAdapter
 *
 * @package Instagram\SDK\DTO\Direct\Adapters
 * @phan-file-suppress PhanUnreferencedUseNormal
 */
class ThreadAdapter extends TypeAdapter
{
    /**
     * @var TypeAdapter
     */
    private $defaultTypeAdapter;

    /**
     * ThreadItemAdapter constructor.
     *
     * @param TypeAdapter $defaultTypeAdapter
     */
    public function __construct(TypeAdapter $defaultTypeAdapter)
    {
        $this->defaultTypeAdapter = $defaultTypeAdapter;
    }

    /**
     * @param mixed         $value
     * @param ReaderContext $context
     * @return mixed
     */
    public function read($value, ReaderContext $context)
    {
        /** @var Thread $deserialized */
        $deserialized = $this->defaultTypeAdapter->read($value, $context);

        $test = new SetByClosure('parent', ThreadItem::class);

        foreach ($deserialized->getItems() as $threadItem) {
            $test->set($threadItem, $deserialized);
        }

        return $deserialized;
    }

    /**
     * @param mixed         $value
     * @param WriterContext $context
     * @return mixed
     */
    public function write($value, WriterContext $context)
    {
        return $this->defaultTypeAdapter->write($value, $context);
    }
}
