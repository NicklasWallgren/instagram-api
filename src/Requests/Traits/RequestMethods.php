<?php

namespace Instagram\SDK\Requests\Traits;

use Instagram\SDK\Requests\Request;
use Instagram\SDK\Requests\Utils\SignatureUtils;

/**
 * Trait RequestMethods
 *
 * @package Instagram\SDK\Requests\Traits
 */
trait RequestMethods
{

    /**
     * Adds a unique context to the payload.
     *
     * @param Request|null $request
     * @return static
     */
    public function addUniqueContext(?Request $request = null): self
    {
        $request = $request ?: $this;

        $request->addPayloadParam('client_context', SignatureUtils::uuid(SignatureUtils::TYPE_DEFAULT));

        return $request;
    }

    /**
     * Adds the CSRF token.
     *
     * @param Request|null $request
     * @return static
     * @throws \Exception
     */
    public function addCSRFToken(?Request $request = null): self
    {
        $request = $request ?: $this;

        $request->addPayloadParam('_csrftoken', $this->session->getCsrfToken()->getToken());

        return $request;
    }

    /**
     * Adds the CSRF token and User id to the payload.
     *
     * @param Request|null $request
     * @return static
     * @throws \Exception
     */
    public function addCSRFTokenAndUserId(?Request $request = null): self
    {
        $request = $request ?: $this;

        $request->addPayloadParam('_csrftoken', $this->session->getCsrfToken()->getToken());
        $request->addPayloadParam('_uid', $this->session->getUser()->getId());

        return $request;
    }

    /**
     * Adds the ranked token as a query parameter.
     *
     * @param Request|null $request
     * @return static
     */
    public function addRankedToken(?Request $request = null): self
    {
        $request = $request ?: $this;

        $request->addQueryParam('rank_token', $this->session->getRankedToken());

        return $request;
    }

    /**
     * Adds uuid to the payload.
     *
     * @param Request|null $request
     * @return self
     */
    public function addUuid(?Request $request = null): self
    {
        $request = $request ?: $this;

        $request->addPayloadParam('_uuid', $this->session->getUuid());

        return $request;
    }

    /**
     * Adds uid to the payload.
     *
     * @param Request|null $request
     * @return static
     */
    public function addUid(?Request $request = null): self
    {
        $request = $request ?: $this;

        $request->addPayloadParam('_uid', $this->session->getUser()->getId());

        return $request;
    }

    /**
     * Adds Uuid and Uid to the payload.
     *
     * @param Request|null $request
     * @return static
     */
    public function addUuidAndUid(?Request $request = null): self
    {
        $request = $request ?: $this;

        // @phan-suppress-next-line PhanPartialTypeMismatchArgument
        $this->addUuid($request);

        // @phan-suppress-next-line PhanPartialTypeMismatchArgument
        $this->addUid($request);

        return $request;
    }

    /**
     * Adds the phone id to the payload.
     *
     * @param Request|null $request
     * @return static
     */
    public function addPhoneId(?Request $request = null): self
    {
        $request = $request ?: $this;

        $request->addPayloadParam('phone_id', $this->session->getDevice()->phoneId());

        return $request;
    }

    /**
     * Adds the session id to the payload.
     *
     * @param Request|null $request
     * @return static
     */
    public function addSessionId(?Request $request = null): self
    {
        $request = $request ?: $this;

        $request->addPayloadParam('session_id', $this->session->getSessionId());

        return $request;
    }

}
