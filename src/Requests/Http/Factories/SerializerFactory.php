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

    public const TYPE_SIGNED = 0;
    public const TYPE_URL_ENCODED = 1;
    public const VALID_SERIALIZERS = [self::TYPE_SIGNED, self::TYPE_URL_ENCODED];

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
            case self::TYPE_SIGNED:
                return new HashRequestSerializer();
            case self::TYPE_URL_ENCODED:
                return new UrlEncodeRequestSerializer();
            default:
        }
    }
}
