<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\DTO\Direct\Adapters;

use Instagram\SDK\Response\DTO\Adapters\OnDecodeContext;
use Instagram\SDK\Response\DTO\Direct\Thread;
use Instagram\SDK\Response\DTO\Direct\ThreadItem;
use Tebru\Gson\Context\ReaderContext;
use Tebru\Gson\Context\WriterContext;
use Tebru\Gson\Internal\AccessorStrategy\SetByClosure;
use Tebru\Gson\TypeAdapter;

/**
 * Class ThreadAdapter
 *
 * @package            Instagram\SDK\Response\DTO\Direct\Adapters
 * @phan-file-suppress PhanUnreferencedUseNormal
 */
final class ThreadAdapter extends TypeAdapter
{
    /** @var TypeAdapter */
    private $defaultTypeAdapter;

    /**
     * ThreadAdapter constructor.
     *
     * @param TypeAdapter $defaultTypeAdapter
     */
    public function __construct(TypeAdapter $defaultTypeAdapter)
    {
        $this->defaultTypeAdapter = $defaultTypeAdapter;
    }

    /**
     * @inheritDoc
     */
    public function read($value, ReaderContext $context)
    {
        $deserialized = $this->defaultTypeAdapter->read($value, $context);

        if (is_array($deserialized)) {
            /** @var Thread $deserialized */
            foreach ($deserialized as $thread) {
                // @phan-suppress-next-line PhanTypeMismatchArgument
                $this->propagate($thread, $context);
            }

            return $deserialized;
        }

        /** @var Thread $deserialized */
        // @phan-suppress-next-line PhanTypeMismatchArgument
        $this->propagate($deserialized, $context);

        return $deserialized;
    }

    /**
     * @inheritDoc
     */
    public function write($value, WriterContext $context)
    {
        return $this->defaultTypeAdapter->write($value, $context);
    }

    public function propagate(Thread $thread, OnDecodeContext $context): void
    {
        $closure = new SetByClosure('parent', ThreadItem::class);

        foreach ($thread->getItems() as $threadItem) {
            $closure->set($threadItem, $thread);

            $threadItem->onDecode($context);
        }

        $thread->onDecode($context);
    }
}
