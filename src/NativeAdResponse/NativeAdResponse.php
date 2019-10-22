<?php

namespace OpenRtb\NativeAdResponse;

use OpenRtb\Tools\Interfaces\Arrayable;
use OpenRtb\Tools\Traits\SetterValidation;
use OpenRtb\Tools\Traits\ToArray;

class NativeAdResponse implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * @required
     * @var Native
     */
    protected $native;

    /**
     * @return Native
     */
    public function getNative()
    {
        return $this->native;
    }

    /**
     * @param Native $native
     * @return $this
     */
    public function setNative(Native $native)
    {
        $this->native = $native;
        return $this;
    }
}
