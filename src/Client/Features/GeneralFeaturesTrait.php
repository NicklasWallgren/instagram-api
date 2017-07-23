<?php

namespace Instagram\SDK\Client\Features;

use Exception;
use GuzzleHttp\Promise\Promise;
use Instagram\SDK\Requests\General\HeaderRequest;
use Instagram\SDK\Requests\Support\SignatureSupport;
use function Instagram\SDK\Support\Promises\task;
use function Instagram\SDK\Support\uuid;

trait GeneralFeaturesTrait
{

    use DefaultFeaturesTrait;

    /**
     * Returns the headers containing the initial CSRF token.
     *
     * @throws Exception
     * @return Promise<HeaderMessage>
     */
    protected function headers()
    {
        return task(function () {
            // Check whether the user is authenticated or not
            if (!$this->isSessionAvailable()) {
                return new Exception('The session is not available. Please authenticate first');
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
