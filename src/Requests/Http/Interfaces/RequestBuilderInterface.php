<?php

namespace NicklasW\Instagram\Requests\Http\Interfaces;

interface RequestBuilderInterface
{

    /**
     * Returns the method type.
     *
     * @return string
     */
    public function getType(): string;

    /**
     * Returns the request full uri.
     *
     * @return string
     */
    public function getUri(): string;

    /**
     * Returns the default headers.
     *
     * @return array
     */
    public function getHeaders(): array;

    /**
     * Returns the payload.
     *
     * @return string|null
     */
    public function getBody(): ?string;
}
