<?php

namespace OpenRtb\NativeAdResponse;

use OpenRtb\Tools\Interfaces\Arrayable;
use OpenRtb\Tools\Traits\SetterValidation;
use OpenRtb\Tools\Traits\ToArray;

class Title implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * The text associated with the text element
     * @required
     * @var string
     */
    protected $text;

    /**
     * @var Ext
     */
    protected $ext;

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setText($text)
    {
        $this->validateString($text);
        $this->text = $text;
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
     * @param $ext
     * @return $this
     */
    public function setExt(Ext $ext)
    {
        $this->ext = $ext;
        return $this;
    }
}
