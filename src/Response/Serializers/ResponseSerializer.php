<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Serializers;

use Instagram\SDK\Client\Client;
use Instagram\SDK\Response\Responses\ResponseEnvelope;

/**
 * Class Serializer
 *
 * @package Instagram\SDK\Response\Serializers
 */
final class ResponseSerializer extends AbstractResponseSerializer
{

    /** @var Client */
    private $client;

    /** @var ResponseEnvelope */
    private $response;

    /**
     * ResponseSerializer constructor.
     *
     * @param Client           $client
     * @param ResponseEnvelope $response
     */
    public function __construct(Client $client, ResponseEnvelope $response)
    {
        $this->client = $client;
        $this->response = $response;
    }

    /**
     * @inheritDoc
     */
    protected function response(): ResponseEnvelope
    {
        return $this->response;
    }
}
