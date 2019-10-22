<?php

namespace OpenRtb\NativeAdResponse;

use OpenRtb\Tools\Interfaces\Arrayable;
use OpenRtb\Tools\Traits\SetterValidation;
use OpenRtb\Tools\Traits\ToArray;

class Video implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * VAST xml
     * @required
     * @var string
     */
    protected $vasttag;

    /**
     * @return string
     */
    public function getVasttag()
    {
        return $this->vasttag;
    }

    /**
     * @param string $vasttag
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setVasttag($vasttag)
    {
        $this->validateString($vasttag);
        $this->vasttag = $vasttag;
        return $this;
    }
}
