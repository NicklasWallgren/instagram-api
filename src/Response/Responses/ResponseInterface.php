<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Responses;

use Psr\Http\Message\ResponseInterface as HttpResponseInterface;

/**
 * Interface ResponseInterface
 *
 * @package Instagram\SDK\Response\Interfaces
 */
interface ResponseInterface
{
    /**
     * raw http response getter, useful for debugging, using not implemented things
     *
     * @return HttpResponseInterface
     */
    public function getRawResponse(): HttpResponseInterface;

    /**
     * @param HttpResponseInterface $response
     * @return ResponseInterface
     */
    public function setRawResponse(HttpResponseInterface $response): ResponseInterface;
}
