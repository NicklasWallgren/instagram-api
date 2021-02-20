<?php

namespace Instagram\SDK\Requests\Options;

use Instagram\SDK\Requests\Request;

/**
 * Class AbstractOptions
 *
 * @package Instagram\SDK\Requests\Options
 */
class AbstractOptions
{

    /**
     * Adds options as payload parameter to the generic request.
     *
     * @param Request $request
     * @return void
     */
    public function addAsPayload(Request $request): void
    {
        foreach (get_defined_vars() as $parameter => $value) {
            $request->addPayloadParam($this->underscore($parameter), $value);
        }
    }

    /**
     * Add options as query parameters to the generic request.
     *
     * @param Request $request
     * @return void
     */
    public function addAsQuery(Request $request): void
    {
        foreach (get_defined_vars() as $parameter => $value) {
            $request->addQueryParam($this->underscore($parameter), $value);
        }
    }

    /**
     * Converts the value into the expected API value.
     *
     * @param mixed $value
     * @return mixed
     */
    protected function value($value)
    {
        if (is_bool($value)) {
            return (int)$value;
        }

        return $value;
    }

    /**
     * Returns the camel cased string as underscore case.
     *
     * @param string $target
     * @return string
     */
    protected function underscore(string $target): string
    {
        return strtolower(preg_replace('/(?<=\\w)([A-Z])/', '_\\1', $target));
    }

}
