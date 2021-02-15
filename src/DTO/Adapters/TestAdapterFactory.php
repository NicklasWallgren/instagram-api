<?php

namespace Instagram\SDK\DTO\Adapters;

use Tebru\Gson\Internal\TypeAdapterProvider;
use Tebru\Gson\TypeAdapter;
use Tebru\Gson\TypeAdapterFactory;
use Tebru\PhpType\TypeToken;

/**
 * Class ThreadAdapterFactory
 *
 * @package Instagram\SDK\DTO\Direct\Adapters
 */
class TestAdapterFactory implements TypeAdapterFactory
{

    /**
     * @inheritDoc
     * @phan-suppress PhanThrowTypeAbsentForCall
     */
    public function create(TypeToken $type, TypeAdapterProvider $typeAdapterProvider): ?TypeAdapter
    {
        return new TestAdapter($typeAdapterProvider->getAdapter($type));
    }
}
