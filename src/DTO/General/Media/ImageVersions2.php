<?php

namespace NicklasW\Instagram\DTO\General\Media;

class ImageVersions2
{

    /**
     * @var \NicklasW\Instagram\DTO\General\Media\Image[]
     * @name candidates
     */
    protected $candidates;

    /**
     * @return Image[]
     */
    public function getCandidates()
    {
        return $this->candidates;
    }
}
