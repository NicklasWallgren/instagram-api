<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\DTO\Adapters;

use Instagram\SDK\Response\Serializers\Interfaces\OnResponseDecodeInterface;
use Tebru\Gson\Context\ReaderContext;
use Tebru\Gson\Context\WriterContext;
use Tebru\Gson\TypeAdapter;

/**
 * Class OnDecodePropagatorAdapter
 *
 * @package Instagram\SDK\Response\DTO\Adapters
 */
final class OnDecodePropagatorAdapter extends TypeAdapter
{
    /**
     * @var TypeAdapter
     */
    private $defaultTypeAdapter;

    /**
     * OnDecodePropagatorAdapter constructor.
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

        if (is_iterable($deserialized)) {
            foreach ($deserialized as $item) {
                // @phan-suppress-next-line PhanTypeMismatchArgument
                self::handleOnDecode($item, $context);
            }

            return $deserialized;
        }

        // @phan-suppress-next-line PhanTypeMismatchArgument
        self::handleOnDecode($deserialized, $context);

        return $deserialized;
    }

    /**
     * @inheritDoc
     */
    public function write($value, WriterContext $context)
    {
        return $this->defaultTypeAdapter->write($value, $context);
    }

    private static function handleOnDecode(object $subject, OnDecodeContext $context): void
    {
        if (!$subject instanceof OnResponseDecodeInterface) {
            return;
        }

        $subject->onDecode($context);
    }
}
