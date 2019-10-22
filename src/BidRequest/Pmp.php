<?php

namespace OpenRtb\BidRequest;

use OpenRtb\Tools\Interfaces\Arrayable;
use OpenRtb\BidRequest\Specification\BitType;
use OpenRtb\Tools\Traits\SetterValidation;
use OpenRtb\Tools\Traits\ToArray;
use OpenRtb\Tools\Classes\ArrayCollection;

class Pmp implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * Indicator of auction eligibility to seats named in the Direct Deals object,
     * where 0 = all bids are accepted, 1 = bids are restricted to the deals specified and the terms thereof.
     *
     * @var int
     */
    protected $private_auction;

    /**
     * Array of Deal objects that convey the specific deals applicable to this impression.
     *
     * Array of Deal
     * @var ArrayCollection
     */
    protected $deals;

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
        $this->setDeals(new ArrayCollection());
    }

    /**
     * @return int
     */
    public function getPrivate_auction()
    {
        return $this->private_auction;
    }

    /**
     * @param int $private_auction
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setPrivate_auction($private_auction)
    {
        $this->validateIn($private_auction, BitType::getAll());
        $this->private_auction = $private_auction;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getDeals()
    {
        return $this->deals;
    }

    /**
     * @param Deal $deals
     * @return $this
     */
    public function addDeals(Deal $deals)
    {
        $this->deals->add($deals);
        return $this;
    }

    /**
     * @param ArrayCollection $deals
     * @return $this
     */
    public function setDeals(ArrayCollection $deals)
    {
        $this->deals = $deals;
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
