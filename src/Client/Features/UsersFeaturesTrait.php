<?php

declare(strict_types=1);

namespace Instagram\SDK\Client\Features;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\DTO\Messages\Users\UserInformationMessage;
use function GuzzleHttp\Promise\task;

/**
 * Trait AccountFeaturesTrait
 *
 * @package            Instagram\SDK\Client\Features
 * @phan-file-suppress PhanUnreferencedUseNormal
 */
trait UsersFeaturesTrait
{

    use DefaultFeaturesTrait;

    /**
     * Returns detailed information about a user by username.
     *
     * @param string $username The username
     * @return PromiseInterface<UserInformationMessage>
     */
    public function getUserByName(string $username): PromiseInterface
    {
        return task(function () use ($username): PromiseInterface {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            $request = $this->buildRequest(
                sprintf('users/%s/usernameinfo/', $username),
                new UserInformationMessage(),
                'GET'
            );

            return $request->fire();
        });
    }

    /**
     * Returns detailed information about a user by id.
     *
     * @param string $userId
     * @return PromiseInterface<UserInformationMessage>
     */
    public function getUserById(string $userId): PromiseInterface
    {
        return task(function () use ($userId): PromiseInterface {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkPrerequisites();

            $request = $this->buildRequest(sprintf('users/%s/info/', $userId), new UserInformationMessage(), 'GET');

            $request->addPayloadParam('device_id', $this->session->getDevice()->deviceId());

            return $request->fire();
        });
    }
}
