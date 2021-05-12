<?php

declare(strict_types=1);

namespace Instagram\SDK\Request\Http\Factories;

use Instagram\SDK\Request\Http\Serializers\HashPayloadSerializer;
use Instagram\SDK\Request\Http\Serializers\PayloadSerializerInterface;
use Instagram\SDK\Request\Http\Serializers\UrlEncodePayloadSerializer;
use InvalidArgumentException;
use Webmozart\Assert\Assert;

/**
 * Class PayloadSerializerFactory
 *
 * @package Instagram\SDK\Request\Http\Factories
 */
final class PayloadSerializerFactory
{

    public const TYPE_SIGNED = 0;
    public const TYPE_URL_ENCODED = 1;
    public const VALID_SERIALIZERS = [self::TYPE_SIGNED, self::TYPE_URL_ENCODED];

    /**
     * @param int $type
     * @return PayloadSerializerInterface
     * @throws InvalidArgumentException
     * @phan-suppress PhanPluginAlwaysReturnMethod
     */
    public static function create(int $type): PayloadSerializerInterface
    {
        Assert::oneOf($type, self::VALID_SERIALIZERS);

        switch ($type) {
            case self::TYPE_SIGNED:
                return new HashPayloadSerializer();
            case self::TYPE_URL_ENCODED:
                return new UrlEncodePayloadSerializer();
            default:
        }
    }
}
