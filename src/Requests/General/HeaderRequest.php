<?php

namespace Instagram\SDK\Requests\General;

use Instagram\SDK\DTO\Messages\HeaderMessage;
use Instagram\SDK\Http\RequestClient as HttpClient;
use Instagram\SDK\Requests\GenericRequest;
use Instagram\SDK\Requests\Http\Factories\SerializerFactory;
use Instagram\SDK\Requests\Request;
use Instagram\SDK\Requests\Traits\RequestMethods;
use Instagram\SDK\Responses\Serializers\General\HeaderSerializer;
use Instagram\SDK\Session\Session;
use Instagram\SDK\Support\Promise;
use function Instagram\SDK\Support\requestWithSerializer;

/**
 * Class HeaderRequest
 *
 * @package Instagram\SDK\Requests\General
 */
class HeaderRequest extends Request
{

    use RequestMethods;

    /**
     * @var string
     */
    protected $signature;

    /**
     * HeaderRequest constructor.
     *
     * @param string     $signature The universal unique identifier
     * @param Session    $session
     * @param HttpClient $client
     */
    public function __construct(string $signature, Session $session, HttpClient $client)
    {
        $this->signature = $signature;

        parent::__construct($session, $client);
    }

    /**
     * @inheritDoc
     */
    public function fire(): Promise
    {
        /** @var GenericRequest $request */
        // phpcs:ignore
        $request = requestWithSerializer(new HeaderSerializer($this->httpClient), 'si/fetch_headers/', new HeaderMessage())(
            $this->session,
            $this->httpClient
        );

        // Prepare the payload
        $body = [
            'challenge_type' => 'signup',
            'guid'           => $this->signature,
        ];

        $request->setPayload($body)
            ->setSerializerType(SerializerFactory::TYPE_URL_ENCODED);

        return $request->fire();
    }
}
