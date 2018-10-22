<?php

namespace Instagram\SDK\Requests\Options;

use Instagram\SDK\Requests\GenericRequest;
use function Instagram\SDK\Support\underscore;

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
     * @param GenericRequest $request
     * @return void
     */
    public function addAsPayload(GenericRequest $request): void
    {
        foreach (get_defined_vars() as $parameter => $value) {
            $request->setPost(underscore($parameter), $value);
        }
    }

    /**
     * Add options as query parameters to the generic request.
     *
     * @param GenericRequest $request
     * @return void
     */
    public function addAsQuery(GenericRequest $request): void
    {
        foreach (get_defined_vars() as $parameter => $value) {
            $request->setParam(underscore($parameter), $value);
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
}
