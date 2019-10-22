<?php

namespace OpenRtb\BidRequest;

use OpenRtb\BidRequest\Specification\BitType;
use OpenRtb\Tools\Interfaces\Arrayable;
use OpenRtb\Tools\Traits\SetterValidation;
use OpenRtb\Tools\Traits\ToArray;

class Regs implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * Flag indicating if this request is subject to the COPPA regulations established by the USA FTC,
     * where 0 = no, 1 = yes.
     *
     * @var int
     */
    protected $coppa;

    /**
     * @var Ext
     */
    protected $ext;

    /**
     * @return int
     */
    public function getCoppa()
    {
        return $this->coppa;
    }

    /**
     * @param int $coppa
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setCoppa($coppa)
    {
        $this->validateIn($coppa, BitType::getAll());
        $this->coppa = $coppa;
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
