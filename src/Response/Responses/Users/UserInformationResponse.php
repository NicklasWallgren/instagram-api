<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Responses\Users;

use Instagram\SDK\Client\Client;
use Instagram\SDK\Response\DTO\Adapters\OnDecodeContext;
use Instagram\SDK\Response\DTO\General\User;
use Instagram\SDK\Response\Responses\ResponseEnvelope;
use Instagram\SDK\Response\Serializers\Interfaces\OnResponseDecodeInterface;
use Tebru\Gson\Annotation\JsonAdapter;

/**
 * Class UserInformationResponse
 *
 * @package Instagram\SDK\Response\Responses\Users
 */
final class UserInformationResponse extends ResponseEnvelope implements OnResponseDecodeInterface
{

    /**
     * @var User $user
     * @JsonAdapter("Instagram\SDK\Response\DTO\Adapters\OnDecodePropagatorAdapterFactory")
     */
    private $user;

    /**
     * @var Client
     * @JsonAdapter("Instagram\SDK\Response\DTO\Adapters\OnDecodePropagatorAdapterFactory")
     */
    private $client;

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @inheritDoc
     */
    public function onDecode(OnDecodeContext $context): void
    {
        $this->client = $context->getClient();
    }
}
