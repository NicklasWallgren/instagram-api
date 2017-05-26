<?php

namespace Requests\Http\Factory;

class ParameterFactory
{

    /**
     * @var int The headers type
     */
    const TYPE_HEADERS = 0;

    /**
     * Create request resource.
     *
     * @param int $type
     * @return array|null
     */
    public function create(int $type): ?array
    {
        $resource = null;

        switch ($type) {

            case self::TYPE_HEADERS:




                break;
        }

        return $resource;
    }


}