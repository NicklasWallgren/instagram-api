<?php

namespace Instagram\SDK\Responses\Interfaces;

interface IteratorInterface
{

    /**
     * @return bool
     */
    public function next();

    /**
     * @return bool
     */
    public function rewind();
}
