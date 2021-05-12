<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\DTO\Adapters;

use Tebru\Gson\Internal\TypeAdapterProvider;
use Tebru\Gson\TypeAdapter;
use Tebru\Gson\TypeAdapterFactory;
use Tebru\PhpType\TypeToken;

/**
 * Class OnDecodePropagatorAdapterFactory
 *
 * @package Instagram\SDK\Response\DTO\Adapters
 */
final class OnDecodePropagatorAdapterFactory implements TypeAdapterFactory
{

    /**
     * @inheritDoc
     * @phan-suppress PhanThrowTypeAbsentForCall
     */
    public function create(TypeToken $type, TypeAdapterProvider $typeAdapterProvider): ?TypeAdapter
    {
        return new OnDecodePropagatorAdapter($typeAdapterProvider->getAdapter($type));
    }
}
