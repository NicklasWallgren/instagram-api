<?php

namespace Instagram\SDK\DTO\Adapters;

use Tebru\Gson\Internal\TypeAdapterProvider;
use Tebru\Gson\TypeAdapter;
use Tebru\Gson\TypeAdapterFactory;
use Tebru\PhpType\TypeToken;

/**
 * Class TestAdapterFactory
 *
 * @package Instagram\SDK\DTO\Adapters
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
