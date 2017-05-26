<?php

namespace NicklasW\Instagram\Responses\Serializers\Interfaces;

interface OnDecodeRequirementsInterface
{

    /**
     * Returns the requirements.
     *
     * @return array
     */
    public function requirements();

}