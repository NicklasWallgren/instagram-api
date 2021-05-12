<?php

declare(strict_types=1);

namespace Instagram\SDK\Client\Features;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Response\Responses\Users\UserInformationResponse;

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
     * @return PromiseInterface<UserInformationResponse>
     */
    public function getUserByName(string $username): PromiseInterface
    {
        return $this->authenticated(function () use ($username): PromiseInterface {
            $request = $this->buildRequest(
                sprintf('users/%s/usernameinfo/', $username),
                new UserInformationResponse(),
                'GET'
            );

            return $this->call($request);
        });
    }

    /**
     * Returns detailed information about a user by id.
     *
     * @param string $userId
     * @return PromiseInterface<UserInformationResponse>
     */
    public function getUserById(string $userId): PromiseInterface
    {
        return $this->authenticated(function () use ($userId): PromiseInterface {
            $request = $this->buildRequest(sprintf('users/%s/info/', $userId), new UserInformationResponse(), 'GET');

            $request->addPayloadParam('device_id', $this->session->getDevice()->deviceId());

            return $this->call($request);
        });
    }
}
