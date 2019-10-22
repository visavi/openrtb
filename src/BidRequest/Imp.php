<?php

namespace OpenRtb\BidRequest;

use OpenRtb\Tools\Classes\ArrayCollection;
use OpenRtb\Tools\Interfaces\Arrayable;
use OpenRtb\BidRequest\Specification\BitType;
use OpenRtb\Tools\Traits\SetterValidation;
use OpenRtb\Tools\Traits\ToArray;

/**
 * Class Imp
 * @package OpenRtb\BidRequest
 *
 * This object describes an ad placement or impression being auctioned.
 * A single bid request can include multiple Imp objects, a use case for which might be an exchange that supports selling all ad positions on a given page.
 * Each Imp object has a required ID so that bids can reference them individually.
 *
 * The presence of Banner, Video, or Native objects subordinate to the Imp object indicates the type of impression being offered.
 * The publisher can choose one such type which is the typical case or mix them at their discretion.
 * Any given bid for the impression must conform to one of the offered types.
 */
class Imp implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * A unique identifier for this impression within the context of the bid request (typically, value starts with 1, and increments up to n for n impressions).
     * @required
     * @var string
     */
    protected $id;

    /**
     * A Banner object; required if this impression is offered as a banner ad opportunity.
     * @var Banner
     */
    protected $banner;

    /**
     * Required if this impression is offered as a video ad opportunity.
     * @var Video
     */
    protected $video;

    /**
     * Required if this impression is offered as an audio ad opportunity.
     *
     * @var Audio
     */
    protected $audio;

    /**
     * Name of ad mediation partner, SDK technology, or player responsible for rendering ad (typically video or mobile).
     * Used by some ad servers to customize ad code by partner. Recommended for video and/or apps.
     * Example strings:
     *   UNKNOWN_RENDERER
     *   GOOGLE
     *   PUBLISHER
     *
     * @var string
     */
    protected $displaymanager;

    /**
     * Version of ad mediation partner, SDK technology, or player responsible for rendering ad (typically video or mobile).
     * Used by some ad servers to customize ad code by partner. Recommended for video and/or apps.
     *
     * @var string
     */
    protected $displaymanagerver;

    /**
     * 1 = the ad is interstitial or full screen, 0 = not interstitial
     * @var int
     */
    protected $instl;

    /**
     * Identifier for specific ad placement or ad tag that was used to initiate the auction.
     * This can be useful for debugging of any issues, or for optimization by the buyer.
     *
     * @var string
     */
    protected $tagid;

    /**
     * Minimum bid for this impression expressed in CPM.
     *
     * @default 0
     * @var float
     */
    protected $bidfloor;

    /**
     * Currency specified using ISO-4217 alpha codes.
     * This may be different from bid currency returned by bidder if this is allowed by the exchange.
     * A single currency, obtained from the included billing_id.
     *
     * @default USD
     * @var string
     */
    protected $bidfloorcur;

    /**
     * Indicates the type of browser opened upon clicking the creative in an app, where 0 = embedded, 1 = native.
     * Note that the Safari View Controller in iOS 9.x devices is considered a native browser for purposes of this attribute
     *
     * @var int
     */
    protected $clickbrowser;

    /**
     * Flag to indicate if the impression requires secure HTTPS URL creative assets and markup,
     * where 0 = non-secure, 1 = secure. If omitted, the secure state is unknown, but non-secure HTTP support can be assumed.
     *
     * @var int
     */
    protected $secure;

    /**
     * Array of exchange-specific names of supported iframe busters.
     *
     * Array of strings
     * @var array
     */
    protected $iframebuster;

    /**
     * A Pmp object containing any private marketplace deals in effect for this impression.
     *
     * @var Pmp
     */
    protected $pmp;

    /**
     * A Native object; required if this impression is offered as a native ad opportunity.
     *
     * @var Native
     */
    protected $native;

    /**
     * Advisory as to the number of seconds that may elapse between the auction and the actual impression.
     *
     * @var int
     */
    protected $exp;

    /**
     * An array of Metric object. AdX supplies four metrics for this field: click_through_rate, viewability, completion_rate, and session_depth.
     * The viewability metric is a fraction from 0.00 to 1.00 in the OpenRTB metric, but it's expressed as a percentage [0-100] in the AdX protocol.
     * Refer to the AdSlot object table in the Realtime Bidding Guide for descriptions of these metrics. Note session_depth is an integer value.
     *
     * @var ArrayCollection
     */
    protected $metric;

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
        $this->setPmp(new Pmp());
        $this->setMetric(new ArrayCollection());
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
     * @return Banner
     */
    public function getBanner()
    {
        return $this->banner;
    }

    /**
     * @param Banner $banner
     * @return $this
     */
    public function setBanner(Banner $banner)
    {
        $this->banner = $banner;
        return $this;
    }

    /**
     * @return Video
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param Video $video
     * @return $this
     */
    public function setVideo(Video $video)
    {
        $this->video = $video;
        return $this;
    }

    /**
     * @return Audio
     */
    public function getAudio()
    {
        return $this->audio;
    }

    /**
     * @param Audio $audio
     * @return $this
     */
    public function setAudio(Audio $audio)
    {
        $this->audio = $audio;
        return $this;
    }

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

    /**
     * @return string
     */
    public function getDisplaymanager()
    {
        return $this->displaymanager;
    }

    /**
     * @param string $displaymanager
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setDisplaymanager($displaymanager)
    {
        $this->validateString($displaymanager);
        $this->displaymanager = $displaymanager;
        return $this;
    }

    /**
     * @return string
     */
    public function getDisplaymanagerver()
    {
        return $this->displaymanagerver;
    }

    /**
     * @param string $displaymanagerver
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setDisplaymanagerver($displaymanagerver)
    {
        $this->validateString($displaymanagerver);
        $this->displaymanagerver = $displaymanagerver;
        return $this;
    }

    /**
     * @return int
     */
    public function getInstl()
    {
        return $this->instl;
    }

    /**
     * @param int $instl
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setInstl($instl)
    {
        $this->validateIn($instl, BitType::getAll());
        $this->instl = (int) $instl;
        return $this;
    }

    /**
     * @return string
     */
    public function getTagid()
    {
        return $this->tagid;
    }

    /**
     * @param string $tagid
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setTagid($tagid)
    {
        $this->validateString($tagid);
        $this->tagid = $tagid;
        return $this;
    }

    /**
     * @return float
     */
    public function getBidfloor()
    {
        return $this->bidfloor;
    }

    /**
     * @param float $bidfloor
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setBidfloor($bidfloor)
    {
        $this->bidfloor = $this->validateNumericToFloat($bidfloor);
        return $this;
    }

    /**
     * @return string
     */
    public function getBidfloorcur()
    {
        return $this->bidfloorcur;
    }

    /**
     * @param string $bidfloorcur
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setBidfloorcur($bidfloorcur)
    {
        $this->validateString($bidfloorcur);
        $this->bidfloorcur = $bidfloorcur;
        return $this;
    }

    /**
     * @return int
     */
    public function getSecure()
    {
        return $this->secure;
    }

    /**
     * @param int $secure
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setSecure($secure)
    {
        $this->validateIn($secure, BitType::getAll());
        $this->secure = (int) $secure;
        return $this;
    }

    /**
     * @return array
     */
    public function getIframebuster()
    {
        return $this->iframebuster;
    }

    /**
     * @param string $iframebuster
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addIframebuster($iframebuster)
    {
        $this->validateString($iframebuster);
        $this->iframebuster[] = $iframebuster;
        return $this;
    }

    /**
     * @param array $iframebuster
     * @return $this
     */
    public function setIframebuster(array $iframebuster)
    {
        $this->iframebuster = $iframebuster;
        return $this;
    }

    /**
     * @return Pmp
     */
    public function getPmp()
    {
        return $this->pmp;
    }

    /**
     * @param Pmp $pmp
     * @return $this
     */
    public function setPmp(Pmp $pmp)
    {
        $this->pmp = $pmp;
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
     * @return int
     */
    public function getClickbrowser()
    {
        return $this->clickbrowser;
    }

    /**
     * @param int $clickbrowser
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setClickbrowser($clickbrowser)
    {
        $this->validateIn($clickbrowser, BitType::getAll());
        $this->clickbrowser = (int) $clickbrowser;
        return $this;
    }

    /**
     * @return string
     */
    public function getExp()
    {
        return $this->exp;
    }

    /**
     * @param string $exp
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setExp($exp)
    {
        $this->validateInt($exp);
        $this->exp = $exp;
        return $this;
    }

    /**
     * @param ArrayCollection $metric
     * @return $this
     */
    public function setMetric(ArrayCollection $metric)
    {
        $this->metric = $metric;
        return $this;
    }

    /**
     * @param Metric $metric
     * @return $this
     */
    public function addMetric(Metric $metric = null)
    {
        if (is_null($metric)) {
            $metric = new Metric();
        }
        $this->metric->add($metric);
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getMetric()
    {
        return $this->metric;
    }


}
