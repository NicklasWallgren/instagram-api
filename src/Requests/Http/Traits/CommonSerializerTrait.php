<?php

namespace Instagram\SDK\Requests\Http\Traits;

use Instagram\SDK\Requests\Http\Serializers\HashRequestSerializer;
use Instagram\SDK\Requests\Http\Serializers\RequestSerializerInterface;
use Instagram\SDK\Requests\Http\Serializers\UrlEncodeRequestSerializer;

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
     * @return RequestSerializerInterface
     */
    protected function serializer(): RequestSerializerInterface
    {
        $serializer = new UrlEncodeRequestSerializer();

        switch ($this->mode) {
            case self::$MODE_SIGNED:
                $serializer = new HashRequestSerializer();

                break;

            case self::$MODE_ENCODED:
                $serializer = new UrlEncodeRequestSerializer();

                break;

            default:
        }

        return $serializer;
    }
}
