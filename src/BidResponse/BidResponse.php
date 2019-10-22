<?php

namespace OpenRtb\BidResponse;

use OpenRtb\BidResponse\Specification\NoBidReason;
use OpenRtb\Tools\Interfaces\Arrayable;
use OpenRtb\Tools\Traits\SetterValidation;
use OpenRtb\Tools\Traits\ToArray;
use OpenRtb\Tools\Classes\ArrayCollection;

class BidResponse implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * ID of the bid request to which this is a response.
     *
     * @required
     * @var string
     */
    protected $id;

    /**
     * Array of Seatbid objects; 1+ required if a bid is to be made.
     *
     * Array of Seatbid objects
     * @var ArrayCollection
     */
    protected $seatbid;

    /**
     * Bidder generated response ID to assist with logging/tracking
     *
     * @var string
     */
    protected $bidid;

    /**
     * Bid currency using ISO-4217 alpha codes
     *
     * @default USD
     * @var string
     */
    protected $cur;

    /**
     * Optional feature to allow a bidder to set data in the exchange's cookie.
     * The string must be in base85 cookie safe characters and be in any format.
     * Proper JSON encoding must be used to include "escaped" quotation marks.
     *
     * @var string
     */
    protected $customdata;

    /**
     * Reason for not bidding (NoBidReason)
     *
     * @var int
     */
    protected $nbr;

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
        $this->setSeatbid(new ArrayCollection());
    }

    /**
     * @return false|string
     * @throws \OpenRtb\Tools\Exceptions\ExceptionMissingRequiredField
     */
    public function getBidResponse()
    {
        return json_encode($this->toArray());
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
     * @return ArrayCollection
     */
    public function getSeatbid()
    {
        return $this->seatbid;
    }

    /**
     * @param Seatbid $seatbid
     * @return $this
     */
    public function addSeatbid(Seatbid $seatbid)
    {
        $this->seatbid->add($seatbid);
        return $this;
    }

    /**
     * @param ArrayCollection $seatbid
     * @return $this
     */
    public function setSeatbid(ArrayCollection $seatbid)
    {
        $this->seatbid = $seatbid;
        return $this;
    }

    /**
     * @return string
     */
    public function getBidid()
    {
        return $this->bidid;
    }

    /**
     * @param string $bidid
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setBidid($bidid)
    {
        $this->validateString($bidid);
        $this->bidid = $bidid;
        return $this;
    }

    /**
     * @return string
     */
    public function getCur()
    {
        return $this->cur;
    }

    /**
     * @param string $cur
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setCur($cur)
    {
        $this->validateString($cur);
        $this->cur = $cur;
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
     * @return int
     */
    public function getNbr()
    {
        return $this->nbr;
    }

    /**
     * @param int $nbr
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setNbr($nbr)
    {
        $this->validateIn($nbr, NoBidReason::getAll());
        $this->nbr = $nbr;
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
