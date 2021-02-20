<?php

namespace Instagram\SDK\DTO\Adapters;

use Instagram\SDK\Responses\Serializers\Interfaces\OnDecodeInterface;
use Tebru\Gson\Context\ReaderContext;
use Tebru\Gson\Context\WriterContext;
use Tebru\Gson\TypeAdapter;

/**
 * Class TestAdapter
 *
 * @package            Instagram\SDK\DTO\Adapters
 * @phan-file-suppress PhanUnreferencedUseNormal
 */
class TestAdapter extends TypeAdapter
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
        // OnItemDecodeTypeAdapter


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
                self::handleOnDecode($item, $context);
            }

            return $deserialized;
        }

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

    private static function handleOnDecode($subject, CustomReaderContext $context): void
    {
        if (!$subject instanceof OnDecodeInterface) {
            return;
        }

        $subject->onDecode(['client' => $context->getClient()]);
    }

}
