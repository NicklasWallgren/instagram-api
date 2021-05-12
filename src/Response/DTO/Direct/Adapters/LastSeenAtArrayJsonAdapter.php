<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\DTO\Direct\Adapters;

use Instagram\SDK\Response\DTO\Direct\Collections\LastSeenAtCollection;
use Tebru\Gson\JsonDeserializationContext;
use Tebru\Gson\JsonDeserializer;
use Tebru\PhpType\TypeToken;

/**
 * Class LastSeenAtArrayJsonAdapter
 *
 * @package Instagram\SDK\Response\DTO\Direct\Adapters
 */
final class LastSeenAtArrayJsonAdapter implements JsonDeserializer
{

    /**
     * @inheritDoc
     * @suppress PhanUnusedPublicMethodParameter, PhanUnusedPublicFinalMethodParameter
     */
    public function deserialize($value, TypeToken $type, JsonDeserializationContext $context): LastSeenAtCollection
    {
        return new LastSeenAtCollection(
            $context->deserialize($value, 'array<Instagram\SDK\Response\DTO\Direct\LastSeenAt>')
        );
    }
}
