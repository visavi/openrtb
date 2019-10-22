<?php

namespace OpenRtb\NativeAdRequest;

use OpenRtb\NativeAdRequest\Specification\NativeAdUnit;
use OpenRtb\Tools\Classes\ArrayCollection;
use OpenRtb\NativeAdRequest\Specification\NativeLayout;
use OpenRtb\Tools\Interfaces\Arrayable;
use OpenRtb\Tools\Traits\SetterValidation;
use OpenRtb\Tools\Traits\ToArray;

class NativeAdRequest implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * Number of the Native Markup version in use.
     *
     * @default 1
     * @var string
     */
    protected $ver;

    /**
     * The Layout ID of the native ad unit. RECOMMENDED by OpenRTB Native 1.0; optional in 1.1, to be deprecated.
     *
     * @recommended
     * @var int
     */
    protected $layout;

    /**
     * The Ad unit ID of the native ad unit. This corresponds to one of IAB Core-6 native ad units.
     * RECOMMENDED by OpenRTB Native 1.0; optional in 1.1, to be deprecated.
     *
     * @recommended
     * @var int
     */
    protected $adunit;

    /**
     * @default 1
     * @var int
     */
    protected $plcmtcnt;

    /**
     * @default 0
     * @var int
     */
    protected $seq;

    /**
     * Array of Asset
     * @required
     * @var ArrayCollection
     */
    protected $assets;

    /**
     * @var
     */
    protected $ext;

    public function __construct()
    {
        $this->initialize();
    }

    public function initialize()
    {
        $this->setAssets(new ArrayCollection());
    }

    /**
     * @return string
     */
    public function getRequest()
    {
        return json_encode(['native' => $this->toArray()]);
    }

    /**
     * @return string
     */
    public function getVer()
    {
        return $this->ver;
    }

    /**
     * @param string $ver
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setVer($ver)
    {
        $this->ver = $this->validateVersion($ver);
        return $this;
    }

    /**
     * @return int
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @param int $layout
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setLayout($layout)
    {
        $this->validateIn($layout, NativeLayout::getAll());
        $this->layout = $layout;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdunit()
    {
        return $this->adunit;
    }

    /**
     * @param int $adunit
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setAdunit($adunit)
    {
        $this->validateIn($adunit, NativeAdUnit::getAll());
        $this->adunit = $adunit;
        return $this;
    }

    /**
     * @return int
     */
    public function getPlcmtcnt()
    {
        return $this->plcmtcnt;
    }

    /**
     * @param int $plcmtcnt
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setPlcmtcnt($plcmtcnt)
    {
        $this->plcmtcnt = $this->validateInt($plcmtcnt);
        return $this;
    }

    /**
     * @return int
     */
    public function getSeq()
    {
        return $this->seq;
    }

    /**
     * @param int $seq
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setSeq($seq)
    {
        $this->seq = $this->validateInt($seq);
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getAssets()
    {
        return $this->assets;
    }

    /**
     * @param Assets $assets
     * @return $this
     */
    public function addAssets(Assets $assets)
    {
        $this->assets->add($assets);
        return $this;
    }

    /**
     * @param ArrayCollection $assets
     * @return $this
     */
    public function setAssets(ArrayCollection $assets)
    {
        $this->assets = $assets;
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
