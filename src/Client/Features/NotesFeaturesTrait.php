<?php

declare(strict_types=1);

namespace Instagram\SDK\Client\Features;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Exceptions\InstagramException;
use Instagram\SDK\Request\Http\Factories\PayloadSerializerFactory;
use Instagram\SDK\Request\Utils\SignatureUtils;
use Instagram\SDK\Response\Responses\Common\GeneralResponse;
use Instagram\SDK\Response\Responses\Notes\NotesResponse;
use Instagram\SDK\Response\Responses\ResponseEnvelope;

/**
 * Trait NotesFeaturesTrait
 *
 * @package            Instagram\SDK\Client\Features
 * @phan-file-suppress PhanUnreferencedUseNormal
 */
trait NotesFeaturesTrait
{

    use DefaultFeaturesTrait;

    /**
     * Retrieve notes.
     *
     * @return PromiseInterface<NotesResponse|InstagramException>
     */
    public function notes(): PromiseInterface
    {
        return $this->authenticated(function (): PromiseInterface {
            $request = $this->buildRequest('notes/get_notes/', new NotesResponse(), 'GET');

            return $this->call($request);
        });
    }

    /**
     * Create a note.
     *
     * @param string $text
     * @param int $audience
     * @return PromiseInterface<GeneralResponse|InstagramException>
     */
    public function createNote(string $text, int $audience = 0): PromiseInterface
    {
        return $this->authenticated(function () use ($text, $audience): PromiseInterface {
            $request = $this->buildRequest('notes/create_note/', new GeneralResponse(), 'POST')
                ->addUuid($this->session)
                ->addPayloadParam('text', $text)
                ->addPayloadParam('audience', $audience);

            return $this->call($request);
        });
    }
}
