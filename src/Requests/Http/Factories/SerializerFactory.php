<?php

namespace Instagram\SDK\Requests\Http\Factories;

use Instagram\SDK\Requests\Http\Serializers\HashRequestSerializer;
use Instagram\SDK\Requests\Http\Serializers\RequestSerializerInterface;
use Instagram\SDK\Requests\Http\Serializers\UrlEncodeRequestSerializer;
use InvalidArgumentException;
use Webmozart\Assert\Assert;

/**
 * Class SerializerFactory
 *
 * @package Instagram\SDK\Requests\Http\Factories
 */
class SerializerFactory
{

    public const SIGNED = 0;
    public const ENCODED = 1;
    public const VALID_SERIALIZERS = [self::SIGNED, self::ENCODED];

    /**
     * @param int $type
     * @return RequestSerializerInterface
     * @phan-suppress PhanPluginAlwaysReturnMethod
     * @throws InvalidArgumentException
     */
    public static function create(int $type): RequestSerializerInterface
    {
        Assert::oneOf($type, self::VALID_SERIALIZERS);

        switch ($type) {
            case self::SIGNED:
                return new HashRequestSerializer();
            case self::ENCODED:
                return new UrlEncodeRequestSerializer();
            default:
        }
    }
}
