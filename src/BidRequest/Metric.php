<?php

namespace OpenRtb\BidRequest;

use OpenRtb\Tools\Interfaces\Arrayable;
use OpenRtb\Tools\Traits\SetterValidation;
use OpenRtb\Tools\Traits\ToArray;

/**
 * Class Metric
 * @package OpenRtb\BidRequest
 *
 * This object is associated with an impression as an array of metrics.
 * These metrics can offer insight into the impression to assist with decisioning such as average recent viewability, click-through rate, etc.
 * Each metric is identified by its type, reports the value of the metric, and optionally identifies the source or vendor measuring the value.
 */
class Metric implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var float
     */
    protected $value;

    /**
     * @var string
     */
    protected $vendor;

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $type
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setType($type)
    {
        $this->validateString($type);
        $this->type = $type;

        return $this;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $value
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setValue($value)
    {
        $this->value = $this->validateNumericToFloat($value);

        return $this;
    }

    /**
     * @return string
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * @param $vendor
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setVendor($vendor)
    {
        $this->validateString($vendor);
        $this->vendor = $vendor;

        return $this;
    }


}
