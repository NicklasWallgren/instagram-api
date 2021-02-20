<?php

declare(strict_types=1);

namespace Instagram\SDK\Client\Features;

use Exception;
use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\DTO\Messages\HeaderMessage;
use Instagram\SDK\Requests\Http\Factories\PayloadSerializerFactory;
use Instagram\SDK\Requests\Request;
use Instagram\SDK\Requests\Utils\SignatureUtils;
use Instagram\SDK\Responses\Serializers\General\HeaderSerializer;
use function GuzzleHttp\Promise\rejection_for;
use function GuzzleHttp\Promise\task;

/**
 * Trait GeneralFeaturesTrait
 *
 * @package Instagram\SDK\Client\Features
 */
trait GeneralFeaturesTrait
{

    use DefaultFeaturesTrait;

    /**
     * Returns the headers containing the initial CSRF token.
     *
     * @return PromiseInterface<HeaderMessage>
     * @throws Exception
     */
    protected function headers(): PromiseInterface
    {
        return task(function (): PromiseInterface {
            // Check whether the user is authenticated or not
            if (!$this->isSessionAvailable()) {
                return rejection_for('The session is not available. Please authenticate first');
            }

            /** @var Request $request */
            // phpcs:ignore
            $request = $this->buildRequestWithSerializer('si/fetch_headers/', new HeaderMessage(), new HeaderSerializer($this->client))(
                $this->session,
                $this->httpClient
            );

            // Prepare the payload
            $body = [
                'challenge_type' => 'signup',
                'guid'           => SignatureUtils::uuid(SignatureUtils::TYPE_COMBINED),
            ];

            $request->setPayload($body)
                ->setPayloadSerializerType(PayloadSerializerFactory::TYPE_URL_ENCODED);

            return $this->call($request);
        });
    }

    /**
     * Returns true if session is available, false otherwise.
     *
     * @return bool
     */
    protected function isSessionAvailable(): bool
    {
        return $this->session !== null;
    }
}
