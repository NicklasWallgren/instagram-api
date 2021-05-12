<?php

declare(strict_types=1);

namespace Instagram\SDK\Client\Features;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Exceptions\InstagramException;
use Instagram\SDK\Request\Utils\SignatureUtils;
use Instagram\SDK\Response\Responses\Common\HeaderResponse;
use Instagram\SDK\Utils\PromiseUtils;

/**
 * Trait GeneralFeaturesTrait
 *
 * @package Instagram\SDK\Client\Features
 */
trait GeneralFeaturesTrait
{

    use DefaultFeaturesTrait;

    /**
     * Return the headers containing the initial CSRF token.
     *
     * @return PromiseInterface<HeaderResponse|InstagramException>
     */
    protected function headers(): PromiseInterface
    {
        // @phan-suppress-next-line PhanDeprecatedFunction
        return PromiseUtils::task(function (): PromiseInterface {
            $request = $this->buildRequest('si/fetch_headers/', new HeaderResponse());

            $payload = [
                'challenge_type' => 'signup',
                'guid'           => SignatureUtils::uuid(SignatureUtils::TYPE_COMBINED),
            ];

            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $request->setPayload($payload);

            return $this->call($request);
        });
    }
}
