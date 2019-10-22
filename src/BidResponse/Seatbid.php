<?php

namespace OpenRtb\BidResponse;

use OpenRtb\BidResponse\Specification\BitType;
use OpenRtb\Tools\Interfaces\Arrayable;
use OpenRtb\Tools\Traits\SetterValidation;
use OpenRtb\Tools\Traits\ToArray;
use OpenRtb\Tools\Classes\ArrayCollection;

class Seatbid implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * Array of 1+ Bid objects each related to an impression. Multiple bids can relate to the same impression.
     *
     * Array of Bid objects
     * @required
     * @var ArrayCollection
     */
    protected $bid;

    /**
     * ID of the buyer seat (e.g., advertiser, agency) on whose behalf this bid is made.
     * This ID will be used to breakdown spend and invalid traffic metrics in IVT transparency reporting, given that it is no longer than 64 bytes.
     *
     * @var string
     */
    protected $seat;

    /**
     * 0 = impressions can be won individually; 1 = impressions must be won or lost as a group
     * @default 0
     * @var int
     */
    protected $group;

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
        $this->setBid(new ArrayCollection());
    }

    /**
     * @return ArrayCollection
     */
    public function getBid()
    {
        return $this->bid;
    }

    /**
     * @param Bid $bid
     * @return $this
     */
    public function addBid(Bid $bid)
    {
        $this->bid->add($bid);
        return $this;
    }

    /**
     * @param ArrayCollection $bid
     * @return $this
     */
    public function setBid(ArrayCollection $bid)
    {
        $this->bid = $bid;
        return $this;
    }

    /**
     * @return string
     */
    public function getSeat()
    {
        return $this->seat;
    }

    /**
     * @param string $seat
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setSeat($seat)
    {
        $this->validateString($seat);
        $this->seat = $seat;
        return $this;
    }

    /**
     * @return int
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param int $group
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setGroup($group)
    {
        $this->validateIn($group, BitType::getAll());
        $this->group = $group;
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
