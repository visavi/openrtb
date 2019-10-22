<?php

namespace OpenRtb\BidRequest;

use OpenRtb\BidRequest\Specification\Gender;
use OpenRtb\Tools\Interfaces\Arrayable;
use OpenRtb\Tools\Traits\SetterValidation;
use OpenRtb\Tools\Traits\ToArray;
use OpenRtb\Tools\Classes\ArrayCollection;

class User implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * Exchange-specific ID for the user. At least one of id or buyerid is recommended
     *
     * @recommended
     * @var string
     */
    protected $id;

    /**
     * Buyer-specific ID for the user as mapped by the exchange for the buyer. At least one of buyerid or id is recommended.
     *
     * @recommended
     * @var string
     */
    protected $buyerid;

    /**
     * Gender as "M" male, "F" female, "O" Other. (Null indicates unknown)
     *
     * @var string
     */
    protected $gender;

    /**
     * Comma separated list of keywords, interests, or intent
     * @var string
     */
    protected $keywords;

    /**
     * Optional feature to pass bidder data set in the exchange's cookie.
     * The string must be in base85 cookie safe characters and be in any format.
     * Proper JSON encoding must be used to include "escaped" quotation marks
     *
     * @var string
     */
    protected $customdata;

    /**
     * Location of the user's home base defined by a Geo object. This is not necessarily their current location.
     *
     * @var Geo
     */
    protected $geo;

    /**
     * Additional contextual data. Each Data object represents a different data source.
     * segment.id references the exchange-detected vertical of the page.
     * segment.value corresponds to the weight of that detected vertical, a higher weight suggesting the page is more relevant for the detected vertical.
     *
     * Additional user data - array of Data
     * @var ArrayCollection
     */
    protected $data;

    /**
     * @var Ext
     */
    protected $ext;

    public function __construct()
    {
        $this->initialize();
    }

    public function initialize()
    {
        $this->setGeo(new Geo());
        $this->setData(new ArrayCollection());
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setId($id)
    {
        $this->validateString($id);
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getBuyerid()
    {
        return $this->buyerid;
    }

    /**
     * @param string $buyerid
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setBuyerid($buyerid)
    {
        $this->validateString($buyerid);
        $this->buyerid = $buyerid;
        return $this;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setGender($gender)
    {
        $this->validateIn($gender, Gender::getAll());
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return string
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param string $keywords
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setKeywords($keywords)
    {
        $this->validateString($keywords);
        $this->keywords = $keywords;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomdata()
    {
        return $this->customdata;
    }

    /**
     * @param string $customdata
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setCustomdata($customdata)
    {
        $this->validateString($customdata);
        $this->customdata = $customdata;
        return $this;
    }

    /**
     * @return Geo
     */
    public function getGeo()
    {
        return $this->geo;
    }

    /**
     * @param Geo $geo
     * @return $this
     */
    public function setGeo(Geo $geo)
    {
        $this->geo = $geo;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param Data $data
     * @return $this
     */
    public function addData(Data $data = null)
    {
        if (is_null($data)) {
            $data = new Data();
        }
        $this->data->add($data);
        return $this;
    }

    /**
     * @param ArrayCollection $data
     * @return $this
     */
    public function setData(ArrayCollection $data)
    {
        $this->data = $data;
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


}
