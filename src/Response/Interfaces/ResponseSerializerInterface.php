<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Interfaces;

use Instagram\SDK\Client\Client;
use Instagram\SDK\Response\Responses\ResponseInterface;
use Psr\Http\Message\ResponseInterface as HttpResponseInterface;

/**
 * Interface SerializerInterface
 *
 * @package Instagram\SDK\Response\Interfaces
 */
interface ResponseSerializerInterface
{

    /**
     * Decodes the response message.
     *
     * @param HttpResponseInterface $response
     * @param Client                $client
     * @return ResponseInterface
     */
    public function decode(HttpResponseInterface $response, Client $client): ResponseInterface;
}
