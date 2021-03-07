<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Serializers\User;

use Exception;
use Instagram\SDK\Client\Client;
use Instagram\SDK\Device\DeviceInterface;
use Instagram\SDK\Request\Http\HttpClient;
use Instagram\SDK\Request\Utils\SignatureUtils;
use Instagram\SDK\Response\Responses\ResponseInterface;
use Instagram\SDK\Response\Responses\User\AuthenticatedUserResponse;
use Instagram\SDK\Response\Responses\User\SessionResponse;
use Instagram\SDK\Response\Serializers\AbstractResponseSerializer;
use Instagram\SDK\Session\Session;
use Psr\Http\Message\ResponseInterface as HttpResponseInterface;
use Tebru\Gson\Internal\AccessorStrategy\SetByClosure;

/**
 * Class LoginSerializer
 *
 * @package Instagram\SDK\Response\Serializers\User
 */
final class LoginResponseSerializer extends AbstractResponseSerializer
{

    /** @var HttpClient */
    private $client;

    /** @var DeviceInterface */
    private $device;

    /**
     * LoginResponseSerializer constructor.
     *
     * @param DeviceInterface $device
     * @param HttpClient      $client
     */
    public function __construct(DeviceInterface $device, HttpClient $client)
    {
        $this->client = $client;
        $this->device = $device;
    }

    /**
     * Decodes the response message.
     *
     * @suppress PhanTypeMismatchArgument
     * @suppress PhanUndeclaredMethod
     * @param HttpResponseInterface $response
     * @param Client                $client
     * @return ResponseInterface
     * @throws Exception
     */
    public function decode(HttpResponseInterface $response, Client $client): ResponseInterface
    {
        /** @var SessionResponse $response */
        $response = parent::decode($response, $client);

        $session = new Session(
            SignatureUtils::uuid(),
            $response->getLoggedInUser(),
            $this->device,
            SignatureUtils::uuid(),
            $this->client->getCookies()
        );

        $closure = new SetByClosure('session', Client::class);
        $closure->set($client, $session);

        return new AuthenticatedUserResponse($session);
    }

    /**
     * @inheritDoc
     */
    protected function response(): SessionResponse
    {
        return new SessionResponse();
    }
}
