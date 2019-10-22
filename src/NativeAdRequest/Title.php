<?php

namespace OpenRtb\NativeAdRequest;

use OpenRtb\Tools\Interfaces\Arrayable;
use OpenRtb\Tools\Traits\SetterValidation;
use OpenRtb\Tools\Traits\ToArray;

class Title implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * Maximum length of the text in the title element
     * @required
     * @var int
     */
    protected $len;

    /**
     * @var
     */
    protected $ext;

    /**
     * @return int
     */
    public function getLen()
    {
        return $this->len;
    }

    /**
     * @param int $len
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setLen($len)
    {
        $this->len = $this->validatePositiveInt($len);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExt()
    {
        return $this->ext;
    }

    /**
     * @param $ext
     * @return $this
     */
    public function setExt($ext)
    {
        $this->ext = $ext;
        return $this;
    }
}
