<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Responses\Users;

use Instagram\SDK\Client\Client;
use Instagram\SDK\Response\DTO\General\User;
use Instagram\SDK\Response\Responses\ResponseEnvelope;
use Tebru\Gson\Annotation\JsonAdapter;

/**
 * Class UserInformationMessage
 *
 * @package Instagram\SDK\Response\Responses\Users
 */
final class UserInformationResponse extends ResponseEnvelope
{

    /** @var User $user */
    private $user;

    /**
     * @var Client
     * @JsonAdapter("Instagram\SDK\Response\DTO\Adapters\OnResponseDecodePropagatorAdapterFactory")
     */
    private $client;

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
