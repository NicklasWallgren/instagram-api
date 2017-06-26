<?php

namespace NicklasW\Instagram\Requests\Http\Traits;

use NicklasW\Instagram\Requests\Http\Serializers\SerializerInterface;
use NicklasW\Instagram\Requests\Http\Serializers\SignSerializer;
use NicklasW\Instagram\Requests\Http\Serializers\UrlEncodeSerializer;

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
     * @return GenericRequest
     */
    public function setMode(int $mode): SerializerInterface
    {
        $this->mode = $mode;

        return $this;
    }

    /**
     * The request body serializer.
     *
     * @return SerializerInterface
     */
    protected function serializer(): SerializerInterface
    {
        $serializer = new UrlEncodeSerializer();

        switch ($this->mode) {
            case self::$MODE_SIGNED:
                $serializer = new SignSerializer();

                break;

            case self::$MODE_ENCODED:
                $serializer = new UrlEncodeSerializer();

                break;

            default:
        }

        return $serializer;
    }
}
