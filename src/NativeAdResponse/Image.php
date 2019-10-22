<?php

namespace OpenRtb\NativeAdResponse;

use OpenRtb\Tools\Interfaces\Arrayable;
use OpenRtb\Tools\Traits\SetterValidation;
use OpenRtb\Tools\Traits\ToArray;

class Image implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * URL of the image asset
     * @required
     * @var string
     */
    protected $url;

    /**
     * Width of the image in pixels
     * @recommended
     * @var int
     */
    protected $w;

    /**
     * Height of the image in pixels
     * @recommended
     * @var int
     */
    protected $h;

    /**
     * @var Ext
     */
    protected $ext;

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setUrl($url)
    {
        $this->validateString($url);
        $this->url = $url;
        return $this;
    }

    /**
     * @return int
     */
    public function getW()
    {
        return $this->w;
    }

    /**
     * @param int $w
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setW($w)
    {
        $this->w = $this->validateInt($w);
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
     * @param int $h
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setH($h)
    {
        $this->h = $this->validateInt($h);
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
