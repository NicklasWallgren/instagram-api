<?php

declare(strict_types=1);

namespace Instagram\SDK\Request;

use Instagram\SDK\Request\Http\Builders\RequestBuilder;
use Instagram\SDK\Request\Http\Factories\PayloadSerializerFactory;
use Instagram\SDK\Request\Http\Utils\CookieUtils;
use Instagram\SDK\Request\Payload\RequestPayloadInterface;
use Instagram\SDK\Request\Utils\SignatureUtils;
use Instagram\SDK\Response\DTO\CsrfToken;
use Instagram\SDK\Session\Session;
use InvalidArgumentException;

/**
 * Trait RequestBuilderMethods
 *
 * @package Instagram\SDK\Request
 */
trait RequestBuilderMethods
{

    /** @var RequestBuilder */
    private $requestBuilder;

    /**
     * Add a query parameter.
     *
     * @param string $parameter
     * @param mixed  $value
     * @return static
     */
    public function addQueryParam(string $parameter, $value): self
    {
        $this->requestBuilder->addQueryParam($parameter, $value);

        return $this;
    }

    /**
     * Add a payload parameter.
     *
     * @param string $parameter
     * @param mixed  $value
     * @return static
     */
    public function addPayloadParam(string $parameter, $value): self
    {
        $this->requestBuilder->addPayloadParam($parameter, $value);

        return $this;
    }

    /**
     * Sets the payload.
     *
     * @param array<string, mixed> $payload
     * @param int                  $serializerType
     * @return static
     * @throws InvalidArgumentException
     */
    public function setPayload(array $payload, int $serializerType = PayloadSerializerFactory::TYPE_URL_ENCODED): self
    {
        $this->requestBuilder->setPayload($payload);
        $this->requestBuilder->setPayloadSerializerType($serializerType);

        return $this;
    }

    /**
     * Add a query parameter if defined.
     *
     * @param string     $name
     * @param mixed|null $value
     * @return static
     */
    public function addQueryParamIfNotNull(string $name, $value): self
    {
        // Check whether the value is defined
        if ($value === null) {
            return $this;
        }

        return $this->addQueryParam($name, $value);
    }

    /**
     * Add a {@link RequestPayloadInterface} instance.
     *
     * @param RequestPayloadInterface $payload
     * @return static
     */
    public function addPayloadParams(RequestPayloadInterface $payload): self
    {
        foreach ($payload->payload() as $payload => $value) {
            $this->addPayloadParam($payload, $value);
        }

        return $this;
    }


    /**
     * Add a unique context to the payload.
     *
     * @return static
     */
    public function addUniqueContext(): self
    {
        $this->addPayloadParam('client_context', SignatureUtils::uuid(SignatureUtils::TYPE_DEFAULT));

        return $this;
    }

    /**
     * Add the CSRF token.
     *
     * @param Session $session
     * @return static
     */
    public function addCSRFToken(Session $session): self
    {
        $this->addPayloadParam('_csrftoken', $this->getCsrfTokenFromCookie($session)->getToken());

        return $this;
    }

    /**
     * Add the CSRF token and User id to the payload.
     *
     * @param Session $session
     * @return static
     */
    public function addCSRFTokenAndUserId(Session $session): self
    {
        $this->addPayloadParam('_csrftoken', $this->getCsrfTokenFromCookie($session)->getToken());
        $this->addPayloadParam('_uid', $session->getUser()->getId());

        return $this;
    }

    /**
     * Add the ranked token as a query parameter.
     *
     * @param Session $session
     * @return static
     */
    public function addRankedToken(Session $session): self
    {
        $this->addQueryParam('rank_token', $session->getRankedToken());

        return $this;
    }

    /**
     * Add uuid to the payload.
     *
     * @param Session $session
     * @return self
     */
    public function addUuid(Session $session): self
    {
        $this->addPayloadParam('_uuid', $session->getUuid());

        return $this;
    }

    /**
     * Add uid to the payload.
     *
     * @param Session $session
     * @return static
     */
    public function addUid(Session $session): self
    {
        $this->addPayloadParam('_uid', $session->getUser()->getId());

        return $this;
    }

    /**
     * Add Uuid and Uid to the payload.
     *
     * @param Session $session
     * @return static
     */
    public function addUuidAndUid(Session $session): self
    {
        $this->addUuid($session);
        $this->addUid($session);

        return $this;
    }

    /**
     * Add the phone id to the payload.
     *
     * @param Session $session
     * @return static
     */
    public function addPhoneId(Session $session): self
    {
        $this->addPayloadParam('phone_id', $session->getDevice()->phoneId());

        return $this;
    }

    /**
     * Add the session id to the payload.
     *
     * @param Session $session
     * @return static
     */
    public function addSessionId(Session $session): self
    {
        $this->addPayloadParam('session_id', $session->getId());

        return $this;
    }

    /**
     * Return the CSRF Token.
     *
     * @param Session $session
     * @return CsrfToken
     */
    private function getCsrfTokenFromCookie(Session $session): CsrfToken
    {
        return new CsrfToken(CookieUtils::getCookieValue('csrftoken', $session->getCookies()));
    }
}
