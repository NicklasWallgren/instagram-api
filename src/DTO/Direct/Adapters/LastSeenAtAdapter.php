<?php

namespace Instagram\SDK\DTO\Direct\Adapters;

use Instagram\SDK\DTO\Direct\Collections\LastSeenAtCollection;
use Tebru\Gson\JsonDeserializationContext;
use Tebru\Gson\JsonDeserializer;
use Tebru\PhpType\TypeToken;

/**
 * Class LastSeenAtAdapter
 *
 * @package Instagram\SDK\DTO\Direct\Adapters
 */
final class LastSeenAtAdapter implements JsonDeserializer
{

    /**
     * @inheritDoc
     * @suppress PhanUnusedPublicMethodParameter
     */
    public function deserialize($value, TypeToken $type, JsonDeserializationContext $context)
    {
        return new LastSeenAtCollection($context->deserialize($value, 'array<Instagram\SDK\DTO\Direct\LastSeenAt>'));
    }
}
