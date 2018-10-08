<?php

namespace Instagram\SDK\Session;

/**
 * Trait SessionMethodsTrait
 *
 * @package Instagram\SDK\Session
 */
trait SessionMethodsTrait
{

    /**
     * Returns the ranked token.
     *
     * @return string
     */
    public function getRankedToken(): string
    {
        return sprintf('%s_%s', $this->getSession()->getUser()->getId(), $this->getSession()->getUuid());
    }

    /**
     * @return Session
     */
    abstract public function getSession(): Session;
}
