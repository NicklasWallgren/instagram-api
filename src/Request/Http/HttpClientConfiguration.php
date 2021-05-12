<?php

declare(strict_types=1);

namespace Instagram\SDK\Request\Http;

/**
 * Class HttpClientConfiguration
 *
 * @package Instagram\SDK\Request\Http
 */
final class HttpClientConfiguration
{

    private const ATTRIBUTE_PROXY_OPTION = 'proxy';

    /** @var string|null */
    private $proxy;

    /**
     * HttpClientConfiguration constructor.
     *
     * @param string|null $proxy
     */
    public function __construct(?string $proxy = null)
    {
        $this->proxy = $proxy;
    }

    /**
     * Returns the configurations as a array.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $configuration = [];

        if ($this->proxy !== null) {
            $configuration[self::ATTRIBUTE_PROXY_OPTION] = $this->proxy;
        }

        return $configuration;
    }
}
