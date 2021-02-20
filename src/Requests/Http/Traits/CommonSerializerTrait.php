<?php

namespace Instagram\SDK\Requests\Http\Traits;

use Instagram\SDK\Requests\Http\Serializers\HashPayloadSerializer;
use Instagram\SDK\Requests\Http\Serializers\PayloadSerializerInterface;
use Instagram\SDK\Requests\Http\Serializers\UrlEncodePayloadSerializer;

/**
 * Trait CommonSerializerTrait
 *
 * @package Instagram\SDK\Requests\Http\Traits
 */
trait CommonSerializerTrait
{

    /**
     * @var int The signed payload mode
     */
    public static $MODE_SIGNED = 1;

    /**
     * @var int The encoded mode
     */
    public static $MODE_ENCODED = 2;

    /**
     * @var int The none mode
     */
    public static $MODE_NONE = 3;

    /**
     * @var int
     */
    protected $mode;

    /**
     * Sets the mode.
     *
     * @param int $mode
     * @return CommonSerializerTrait
     */
    public function setMode(int $mode): self
    {
        $this->mode = $mode;

        return $this;
    }

    /**
     * The request body serializer.
     *
     * @return PayloadSerializerInterface
     */
    protected function serializer(): PayloadSerializerInterface
    {
        $serializer = new UrlEncodePayloadSerializer();

        switch ($this->mode) {
            case self::$MODE_SIGNED:
                $serializer = new HashPayloadSerializer();

                break;

            case self::$MODE_ENCODED:
                $serializer = new UrlEncodePayloadSerializer();

                break;

            default:
        }

        return $serializer;
    }
}
