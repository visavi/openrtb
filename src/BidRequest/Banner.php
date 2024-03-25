<?php

namespace OpenRtb\BidRequest;

use OpenRtb\BidRequest\Specification\AdPosition;
use OpenRtb\BidRequest\Specification\ApiFrameworks;
use OpenRtb\BidRequest\Specification\BannerAdTypes;
use OpenRtb\BidRequest\Specification\CreativeAttributes;
use OpenRtb\BidRequest\Specification\ExpandableDirection;
use OpenRtb\Tools\Classes\ArrayCollection;
use OpenRtb\Tools\Interfaces\Arrayable;
use OpenRtb\BidRequest\Specification\BannerMimeType;
use OpenRtb\Tools\Traits\SetterValidation;
use OpenRtb\Tools\Traits\ToArray;

class Banner implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * Width in device independent pixels (DIPS). If no Format objects are specified, this is an exact width requirement. Otherwise it is a preferred width.
     *
     * @recommended
     * @var int
     */
    protected $w;

    /**
     * Height in device independent pixels (DIPS). If no Format objects are specified, this is an exact height requirement. Otherwise it is a preferred height.
     *
     * @recommended
     * @var int
     */
    protected $h;

    /**
     * Array of Format objects representing the banner sizes permitted. If none are specified, then use of the h and w attributes is highly recommended.
     *
     * @var ArrayCollection
     */
    protected $format;

    /**
     * Unique identifier for this Banner object.
     * Recommended when Banner objects are used with a Video object to represent an array of companion ads.
     * Values usually start at 1 and increase with each object; should be unique within an impression.
     *
     * @var string
     */
    protected $id;

    /**
     * This OpenRTB table has values derived from the IAB Quality Assurance Guidelines (QAG).
     * Practitioners should keep in sync with updates to the QAG values as published on IAB.net. Values "4" - "7" apply to apps per the mobile addendum to QAG version 1.5.
     * Note that Banner.pos only supports one value. If is_sticky, Banner.pos is populated with stickiness.
     * If unknown_stickiness, slot_visibility is used. Stickiness indicates the banner is always onscreen,
     * whereas visibility above-the-fold or below-the-fold can change as the user scrolls.
     *
     * @var int
     */
    protected $pos;

    /**
     * Blocked banner ad types
     * Examples:
     *  XHTML_TEXT_AD = 1; // "Usually mobile".
     *  XHTML_BANNER_AD = 2; // "Usually mobile".
     *  JAVASCRIPT_AD = 3; // JavaScript must be valid xhtml
     *  IFRAME = 4; // Iframe.
     *
     * Array of Integers
     * @var array
     */
    protected $btype;

    /**
     * Blocked creative attributes.
     * Examples:
     *  AUDIO_AUTO_PLAY = 1;
     *  AUDIO_USER_INITIATED = 2;
     *
     * Array of Integers
     * @var array
     */
    protected $battr;

    /**
     * Whitelist of content MIME types supported.
     * Popular MIME types include, but are not limited to "image/jpg", "image/gif" and"application/x-shockwave-flash".
     *
     * Array of Strings
     * @var array
     */
    protected $mimes;

    /**
     * Specify if the banner is delivered in the top frame (true) or in an iframe (false).
     *
     * Values allow: 0 = no, 1 = yes
     * @var int
     */
    protected $topframe;

    /**
     * Directions in which the banner may expand.
     *
     * Array of integers
     * @var array
     */
    protected $expdir;

    /**
     * List of supported API frameworks for this impression. If an API is not explicitly listed, it is assumed not to be supported.
     *
     * Array of integers
     * @var array
     */
    protected $api;

    /**
     * Relevant only for Banner objects used with a Video object in an array of companion ads.
     * Indicates the companion banner rendering mode relative to the associated video, where 0 = concurrent, 1 = end-card.
     * We currently only support end-cards on mApp video interstitials.
     *
     * @var int
     */
    protected $vcm;

    /**
     * Maximum width of the impression in pixels.
     * @deprecated
     *
     * @var int
     */
    protected $wmax;

    /**
     * Maximum height of the impression in pixels.
     * @deprecated
     *
     * @var int
     */
    protected $hmax;

    /**
     * Minimum width of the impression in pixels.
     * @deprecated
     *
     * @var int
     */
    protected $wmin;

    /**
     * Minimum height of the impression in pixels.
     * @deprecated
     *
     * @var int
     */
    protected $hmin;



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
        $this->setFormat(new ArrayCollection());
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
        $this->w = $this->validatePositiveInt($w);
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
        $this->h = $this->validatePositiveInt($h);
        return $this;
    }

    /**
     * @return int
     */
    public function getWmax()
    {
        return $this->wmax;
    }

    /**
     * @param int $wmax
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setWmax($wmax)
    {
        $this->wmax = $this->validatePositiveInt($wmax);
        return $this;
    }

    /**
     * @return int
     */
    public function getHmax()
    {
        return $this->hmax;
    }

    /**
     * @param int $hmax
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setHmax($hmax)
    {
        $this->hmax = $this->validatePositiveInt($hmax);
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
     * @param int $wmin
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setWmin($wmin)
    {
        $this->wmin = $this->validatePositiveInt($wmin);
        return $this;
    }

    /**
     * @return int
     */
    public function getHmin()
    {
        return $this->hmin;
    }

    /**
     * @param int $hmin
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setHmin($hmin)
    {
        $this->hmin = $this->validatePositiveInt($hmin);
        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setId($id)
    {
        $this->validateString($id);
        $this->id = $id;
        return $this;
    }

    /**
     * @return array
     */
    public function getBtype()
    {
        return $this->btype;
    }

    /**
     * @param int $btype
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addBtype($btype)
    {
        $this->validateIn($btype, BannerAdTypes::getAll());
        $this->btype[] = $btype;
        return $this;
    }

    /**
     * @param array $btype
     * @return $this
     */
    public function setBtype(array $btype)
    {
        $this->btype = $btype;
        return $this;
    }

    /**
     * @return array
     */
    public function getBattr()
    {
        return $this->battr;
    }

    /**
     * @param int $battr
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addBattr($battr)
    {
        $this->validateIn($battr, CreativeAttributes::getAll());
        $this->battr[] = $battr;
        return $this;
    }

    /**
     * @param array $battr
     * @return $this
     */
    public function setBattr(array $battr)
    {
        $this->battr = $battr;
        return $this;
    }

    /**
     * @return int
     */
    public function getPos()
    {
        return $this->pos;
    }

    /**
     * @param int $pos
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setPos($pos)
    {
        $this->validateIn($pos, AdPosition::getAll());
        $this->pos = $pos;
        return $this;
    }

    /**
     * @return array
     */
    public function getMimes()
    {
        return $this->mimes;
    }

    /**
     * @param string $mimes
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addMimes($mimes)
    {
        $this->validateIn($mimes, BannerMimeType::getAll());
        $this->mimes[] = $mimes;
        return $this;
    }

    /**
     * @param array $mimes
     * @return $this
     */
    public function setMimes(array $mimes)
    {
        $this->mimes = $mimes;
        return $this;
    }

    /**
     * @return int
     */
    public function getTopframe()
    {
        return $this->topframe;
    }

    /**
     * @param int $topframe
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setTopframe($topframe)
    {
        $this->topframe = $this->validateInt($topframe);
        return $this;
    }

    /**
     * @return array
     */
    public function getExpdir()
    {
        return $this->expdir;
    }

    /**
     * @param int $expdir
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addExpdir($expdir)
    {
        $this->validateIn($expdir, ExpandableDirection::getAll());
        $this->expdir[] = $expdir;
        return $this;
    }

    /**
     * @param array $expdir
     * @return $this
     */
    public function setExpdir(array $expdir)
    {
        $this->expdir = $expdir;
        return $this;
    }

    /**
     * @return array
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * @param int $api
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addApi($api)
    {
        $this->validateIn($api, ApiFrameworks::getAll());
        $this->api[] = $api;
        return $this;
    }

    /**
     * @param array $api
     * @return $this
     */
    public function setApi(array $api)
    {
        $this->api = $api;
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


    /**
     * @param ArrayCollection $format
     * @return $this
     */
    public function setFormat(ArrayCollection $format)
    {
        $this->format = $format;
        return $this;
    }

    /**
     * @param Format $format
     * @return $this
     */
    public function addFormat(Format $format = null)
    {
        if (is_null($format)) {
            $format = new Format();
        }
        $this->format->add($format);
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @return int
     */
    public function getVcm()
    {
        return $this->vcm;
    }

    /**
     * @param $vcm
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setVcm($vcm)
    {
        $this->validateInt($vcm);
        $this->vcm = $vcm;

        return $this;
    }



}
