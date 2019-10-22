<?php

namespace OpenRtb\BidRequest;

use OpenRtb\BidRequest\Specification\LocationService;
use OpenRtb\Tools\Interfaces\Arrayable;
use OpenRtb\BidRequest\Specification\LocationType;
use OpenRtb\Tools\Traits\SetterValidation;
use OpenRtb\Tools\Traits\ToArray;

class Geo implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * Latitude from -90.0 to +90.0, where negative is south
     * @var float
     */
    protected $lat;

    /**
     * Longitude from -180.0 to +180.0, where negative is west
     * @var float
     */
    protected $lon;

    /**
     * Country code using ISO-3166-1-alpha-3
     * @var string
     */
    protected $country;

    /**
     * Region code using ISO-3166-2; 2-letter state code if USA
     * @var string
     */
    protected $region;

    /**
     * Region of a country using FIPS 10-4 notation
     * @var string
     */
    protected $regionfips104;

    /**
     * Google metro code; similar to but not exactly Nielsen DMAs.
     * Refer to the Geographical Targeting page for a link to the codes.
     *
     * @var string
     */
    protected $metro;

    /**
     * City using United Nations Code for Trade & Transport Locations
     * in the format "city": "San Antonio"
     *
     * @var string
     */
    protected $city;

    /**
     * Zip or postal code
     *
     * @var string
     */
    protected $zip;

    /**
     * Source of location data; recommended when passing lat/lon
     *
     * OpenRtb\BidRequest\Specification\LocationType
     * @var int
     */
    protected $type;

    /**
     * Estimated location accuracy in meters; recommended when lat/lon are specified and derived from a device's location services (i.e., type = 1).
     * Note that this is the accuracy as reported from the device.
     * Consult OS specific documentation (e.g., Android, iOS) for exact interpretation.
     *
     * @var int
     */
    protected $accuracy;

    /**
     * Number of seconds since this geolocation fix was established.
     * Note that devices may cache location data across multiple fetches.
     * Ideally, this value should be from the time the actual fix was taken.
     *
     * @var int
     */
    protected $lastfix;

    /**
     * Service or provider used to determine geolocation from IP address if applicable (i.e., type = 2).
     *
     * @var LocationService
     */
    protected $ipservice;

    /**
     * Local time as the number +/- of minutes from UTC
     * @var int
     */
    protected $utcoffset;

    /**
     * @var Ext
     */
    protected $ext;

    /**
     * @return float
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param float $lat
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setLat($lat)
    {
        $this->lat = $this->validateNumericToFloat($lat);
        return $this;
    }

    /**
     * @return float
     */
    public function getLon()
    {
        return $this->lon;
    }

    /**
     * @param float $lon
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setLon($lon)
    {
        $this->lon = $this->validateNumericToFloat($lon);
        return $this;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setType($type)
    {
        $this->validateIn($type, LocationType::getAll());
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setCountry($country)
    {
        $this->validateString($country);
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string $region
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setRegion($region)
    {
        $this->validateString($region);
        $this->region = $region;
        return $this;
    }

    /**
     * @return string
     */
    public function getRegionfips104()
    {
        return $this->regionfips104;
    }

    /**
     * @param string $regionfips104
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setRegionfips104($regionfips104)
    {
        $this->validateString($regionfips104);
        $this->regionfips104 = $regionfips104;
        return $this;
    }

    /**
     * @return string
     */
    public function getMetro()
    {
        return $this->metro;
    }

    /**
     * @param string $metro
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setMetro($metro)
    {
        $this->validateString($metro);
        $this->metro = $metro;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setCity($city)
    {
        $this->validateString($city);
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setZip($zip)
    {
        $this->validateString($zip);
        $this->zip = $zip;
        return $this;
    }

    /**
     * @return int
     */
    public function getUtcoffset()
    {
        return $this->utcoffset;
    }

    /**
     * @param int $utcoffset
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setUtcoffset($utcoffset)
    {
        $this->utcoffset = $this->validateInt($utcoffset);
        return $this;
    }

    /**
     * @return Ext
     */
    public function getExt()
    {
        return $this->ext;
    }

    /**
     * @param Ext $ext
     * @return $this
     */
    public function setExt(Ext $ext)
    {
        $this->ext = $ext;
        return $this;
    }

    /**
     * @return int
     */
    public function getAccuracy()
    {
        return $this->accuracy;
    }

    /**
     * @param $accuracy
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setAccuracy($accuracy)
    {
        $this->validateInt($accuracy);
        $this->accuracy = $accuracy;

        return $this;
    }

    /**
     * @return int
     */
    public function getLastfix()
    {
        return $this->lastfix;
    }

    /**
     * @param $lastfix
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setLastfix($lastfix)
    {
        $this->validateInt($lastfix);
        $this->lastfix = $lastfix;

        return $this;
    }

    /**
     * @return LocationService
     */
    public function getIpservice()
    {
        return $this->ipservice;
    }

    /**
     * @param $ipservice
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setIpservice($ipservice)
    {
        $this->validateIn($ipservice, LocationService::getAll());
        $this->ipservice = $ipservice;

        return $this;
    }


}
