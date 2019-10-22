<?php

namespace OpenRtb\BidRequest;

use OpenRtb\Tools\Interfaces\Arrayable;
use OpenRtb\Tools\Traits\SetterValidation;
use OpenRtb\Tools\Traits\ToArray;

class Deal implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * A unique identifier for the direct deal.
     *
     * @required
     * @var string
     */
    protected $id;

    /**
     * Minimum bid for this impression expressed in CPM.
     *
     * @default 0
     * @var float
     */
    protected $bidfloor;

    /**
     * Currency specified using ISO-4217 alpha codes.
     * This may be different from bid currency returned by bidder if this is allowed by the exchange.default = "USD"
     *
     * @default USD
     * @var string
     */
    protected $bidfloorcur;

    /**
     * Whitelist of buyer seats (e.g., advertisers, agencies) allowed to bid on this deal.
     * IDs of seats and knowledge of the buyer's customers to which they refer must be coordinated between bidders
     * and the exchange a priori. Omission implies no seat restrictions.
     *
     * Array of strings
     * @var array
     */
    protected $wseat;

    /**
     * Array of advertiser domains (e.g., advertiser.com) allowed to bid on this deal. Omission implies no advertiser restrictions
     *
     * array of advertiser domains (e.g., advertiser.com)
     * @var array
     */
    protected $wadomain;

    /**
     * Optional override of the overall auction type of the bid request,
     * where 1 = First Price, 2 = Second Price Plus, 3 = the value passed in bidfloor is the agreed upon deal price.
     * Additional auction types can be defined by the exchange.
     *
     * @var int
     */
    protected $at;

    /**
     * @var Ext
     */
    protected $ext;

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
     * @return float
     */
    public function getBidfloor()
    {
        return $this->bidfloor;
    }

    /**
     * @param float $bidfloor
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setBidfloor($bidfloor)
    {
        $this->bidfloor = $this->validatePositiveFloat($bidfloor);
        return $this;
    }

    /**
     * @return string
     */
    public function getBidfloorcur()
    {
        return $this->bidfloorcur;
    }

    /**
     * @param string $bidfloorcur
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setBidfloorcur($bidfloorcur)
    {
        $this->validateString($bidfloorcur);
        $this->bidfloorcur = $bidfloorcur;
        return $this;
    }

    /**
     * @return int
     */
    public function getAt()
    {
        return $this->at;
    }

    /**
     * @param int $at
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setAt($at)
    {
        $this->at = $this->validateInt($at);
        return $this;
    }

    /**
     * @return array
     */
    public function getWseat()
    {
        return $this->wseat;
    }

    /**
     * @param string $wseat
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addWseat($wseat)
    {
        $this->validateString($wseat);
        $this->wseat[] = $wseat;
        return $this;
    }

    /**
     * @param array $wseat
     * @return $this
     */
    public function setWseat(array $wseat)
    {
        $this->wseat = $wseat;
        return $this;
    }

    /**
     * @return array
     */
    public function getWadomain()
    {
        return $this->wadomain;
    }

    /**
     * @param string $wadomain
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addWadomain($wadomain)
    {
        $this->validateString($wadomain);
        $this->wadomain[] = $wadomain;
        return $this;
    }

    /**
     * @param array $wadomain
     * @return $this
     */
    public function setWadomain(array $wadomain)
    {
        $this->wadomain = $wadomain;
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
