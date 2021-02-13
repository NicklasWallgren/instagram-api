<?php

namespace Instagram\SDK\Client\Features;

use Exception;
use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\DTO\Messages\HeaderMessage;
use Instagram\SDK\Requests\General\HeaderRequest;
use Instagram\SDK\Requests\Support\SignatureSupport;
use Instagram\SDK\Support\Promise;
use function Instagram\SDK\Support\Promises\rejection_for;
use function Instagram\SDK\Support\Promises\task;
use function Instagram\SDK\Support\uuid;

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
     * @throws Exception
     * @return HeaderMessage|PromiseInterface<HeaderMessage>
     */
    protected function headers()
    {
        return task(function (): PromiseInterface {
            // Check whether the user is authenticated or not
            if (!$this->isSessionAvailable()) {
                return rejection_for('The session is not available. Please authenticate first');
            }

            return (new HeaderRequest(uuid(SignatureSupport::TYPE_COMBINED), $this->session, $this->client))->fire();
        })($this->getMode());
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
