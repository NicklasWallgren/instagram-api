<?php

namespace Instagram\SDK\Response\DTO\General\Media;

final class Location
{
    /** @var int */
    private $pk;

    /** @var string */
    private $short_name;

    /** @var int */
    private $facebook_places_id;

    /** @var string */
    private $external_source;

    /** @var string */
    private $name;

    /** @var string */
    private $address;

    /** @var string */
    private $city;

    /** @var float */
    private $lng;

    /** @var float */
    private $lat;

    /** @var bool */
    private $is_eligible_for_guides;

    /**
     * @return int
     */
    public function getPk(): int
    {
        return $this->pk;
    }

    /**
     * @return string
     */
    public function getShortName(): string
    {
        return $this->short_name;
    }

    /**
     * @return int
     */
    public function getFacebookPlacesId(): int
    {
        return $this->facebook_places_id;
    }

    /**
     * @return string
     */
    public function getExternalSource(): string
    {
        return $this->external_source;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return float
     */
    public function getLng(): float
    {
        return $this->lng;
    }

    /**
     * @return float
     */
    public function getLat(): float
    {
        return $this->lat;
    }

    /**
     * @return bool
     */
    public function isIsEligibleForGuides(): bool
    {
        return $this->is_eligible_for_guides;
    }

}
