<?php

namespace NicklasW\Instagram\Responses\Interfaces;

interface IteratorInterface
{

    /**
     * @return bool
     */
    public function next(): bool;

    /**
     * @return bool
     */
    public function rewind(): bool;

}