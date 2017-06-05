<?php

namespace NicklasW\Instagram\Client\Features;

use GuzzleHttp\Promise\Promise;
use NicklasW\Instagram\DTO\Messages\Discover\ExploreMessage;
use NicklasW\Instagram\Requests\Discover\ExploreRequest;

trait DiscoverFeaturesTrait
{

    /**
     * Retrieves the explore items.
     *
     * @return ExploreMessage|Promise<ExploreMessage>
     */
    public function explore()
    {
        return $this->adapter->run(function () {
            $this->checkPrerequisites();

            return (new ExploreRequest($this, $this->session, $this->client))->fire();
        });
    }

}