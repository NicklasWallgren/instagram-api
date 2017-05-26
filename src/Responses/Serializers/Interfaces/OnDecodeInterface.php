<?php

namespace NicklasW\Instagram\Responses\Serializers\Interfaces;

use NicklasW\Instagram\DTO\Envelope;

interface OnDecodeInterface
{

    /**
     * On decode method.
     *
     * @param Envelope $message
     */
    public function onDecode(Envelope &$message): void;

}