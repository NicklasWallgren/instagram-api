<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\DTO\Direct\Adapters;

use Tebru\Gson\Internal\TypeAdapterProvider;
use Tebru\Gson\TypeAdapter;
use Tebru\Gson\TypeAdapterFactory;
use Tebru\PhpType\TypeToken;

/**
 * Class ThreadAdapterFactory
 *
 * @package Instagram\SDK\Response\DTO\Direct\Adapters
 */
final class ThreadAdapterFactory implements TypeAdapterFactory
{

    /**
     * @inheritDoc
     * @phan-suppress PhanThrowTypeAbsentForCall
     */
    public function create(TypeToken $type, TypeAdapterProvider $typeAdapterProvider): ?TypeAdapter
    {
        return new ThreadAdapter($typeAdapterProvider->getAdapter($type));
    }
}
