<?php

namespace OpenRtb\BidRequest;

use OpenRtb\Tools\Interfaces\Arrayable;
use OpenRtb\Tools\Traits\SetterValidation;
use OpenRtb\Tools\Traits\ToArray;

/**
 * Class Metric
 * @package OpenRtb\BidRequest
 *
 * This object represents an allowed size (height and width combination) for a banner impression.
 * These are typically used in an array for an impression where multiple sizes are permitted.
 */
class Format implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * Width in device independent pixels (DIPS).
     *
     * @var int
     */
    protected $w;

    /**
     * Height in device independent pixels (DIPS).
     *
     * @var int
     */
    protected $h;

    /**
     * Relative width when expressing size as a ratio.
     *
     * @var int
     */
    protected $wratio;

    /**
     * Relative height when expressing size as a ratio
     *
     * @var int
     */
    protected $hratio;

    /**
     * The minimum width in device independent pixels (DIPS) at which the ad will be displayed when the size is expressed as a ratio.
     *
     * @var int
     */
    protected $wmin;

    /**
     * @return int
     */
    public function getW()
    {
        return $this->w;
    }

    /**
     * @param $w
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setW($w)
    {
        $this->validateInt($w);
        $this->w = $w;

        return $this;
    }

    /**
     * @return int
     */
    public function getH()
    {
        return $this->h;
    }

    /**
     * @param $h
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setH($h)
    {
        $this->validateInt($h);
        $this->h = $h;

        return $this;
    }

    /**
     * @return int
     */
    public function getWratio()
    {
        return $this->wratio;
    }

    /**
     * @param $wratio
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setWratio($wratio)
    {
        $this->validateInt($wratio);
        $this->wratio = $wratio;

        return $this;
    }

    /**
     * @return int
     */
    public function getHratio()
    {
        return $this->hratio;
    }

    /**
     * @param $hratio
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setHratio($hratio)
    {
        $this->validateInt($hratio);
        $this->hratio = $hratio;

        return $this;
    }

    /**
     * @return int
     */
    public function getWmin()
    {
        return $this->wmin;
    }

    /**
     * @param $wmin
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setWmin($wmin)
    {
        $this->validateInt($wmin);
        $this->wmin = $wmin;

        return $this;
    }

}
