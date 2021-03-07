<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\DTO\Direct\Adapters;

use Instagram\SDK\Response\DTO\Direct\Thread;
use Instagram\SDK\Response\DTO\Direct\ThreadItem;
use Tebru\Gson\Context\ReaderContext;
use Tebru\Gson\Context\WriterContext;
use Tebru\Gson\Internal\AccessorStrategy\SetByClosure;
use Tebru\Gson\TypeAdapter;

/**
 * Class ThreadAdapter
 *
 * @package Instagram\SDK\Response\DTO\Direct\Adapters
 */
final class ThreadAdapter extends TypeAdapter
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

        $closure = new SetByClosure('parent', ThreadItem::class);

        foreach ($deserialized->getItems() as $threadItem) {
            $closure->set($threadItem, $deserialized);

            $threadItem->onDecode($context);
        }

        $deserialized->onDecode($context);

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
