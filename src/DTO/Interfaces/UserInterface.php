<?php

namespace NicklasW\Instagram\DTO\Interfaces;

interface UserInterface
{

    /**
     * Returns the id.
     *
     * @return int
     */
    public function getId(): int;

    /**
     * Returns the username.
     *
     * @return string
     */
    public function getUsername(): string;

    /**
     * Returns the fullname.
     *
     * @return string|null
     */
    public function getFullname(): ?string;

}