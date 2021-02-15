<?php

declare(strict_types=1);

namespace Instagram\SDK\DTO\Messages\Users;

use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\General\User;

/**
 * Class UserInformationMessage
 *
 * @package Instagram\SDK\DTO\Messages\Users
 */
class UserInformationMessage extends Envelope
{

    /**
     * @var User $user
     */
    private $user;

    /**
     * @var Client
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
     * On item decode method.
     *
     * @suppress PhanUnusedPublicMethodParameter
     * @suppress PhanPossiblyNullTypeMismatchProperty
     * @param array<string, mixed> $container
     * @throws Exception
     */
    public function onDecode(array $container): void
    {
        $this->client = $container['client'];

        $this->propagate($container);
    }

}
