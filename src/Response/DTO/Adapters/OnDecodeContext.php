<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\DTO\Adapters;

use Instagram\SDK\Client\Client;
use Tebru\Gson\Context\ReaderContext;

/**
 * Class OnDecodeContext
 *
 * @package Instagram\SDK\Response\DTO\Adapters
 */
final class OnDecodeContext extends ReaderContext
{

    /**
     * @var Client
     */
    private $client;

    /**
     * CustomReaderContext constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }
}
