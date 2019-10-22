<?php

namespace OpenRtb\BidRequest;

use OpenRtb\BidRequest\Specification\AdPosition;
use OpenRtb\BidRequest\Specification\ApiFrameworks;
use OpenRtb\BidRequest\Specification\BitType;
use OpenRtb\BidRequest\Specification\ContentDeliveryMethods;
use OpenRtb\BidRequest\Specification\CreativeAttributes;
use OpenRtb\BidRequest\Specification\PlaybackCessationMode;
use OpenRtb\BidRequest\Specification\VastCompanionTypes;
use OpenRtb\BidRequest\Specification\VideoBidResponseProtocols;
use OpenRtb\BidRequest\Specification\VideoLinearity;
use OpenRtb\BidRequest\Specification\VideoMimeType;
use OpenRtb\BidRequest\Specification\VideoPlacementType;
use OpenRtb\BidRequest\Specification\VideoPlaybackMethods;
use OpenRtb\Tools\Interfaces\Arrayable;
use OpenRtb\Tools\Traits\SetterValidation;
use OpenRtb\Tools\Traits\ToArray;
use OpenRtb\Tools\Classes\ArrayCollection;

class Video implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * Whitelist of content MIME types supported.
     * Popular MIME types include but are not limited to "image/jpg", "image/gif" and "application/x-shockwave-flash".
     * REQUIRED by the OpenRTB specification: at least 1 element.
     *
     * Array of strings
     * @required
     * @var array
     */
    protected $mimes;

    /**
     * Indicates if the impression must be linear, nonlinear, etc. If none specified, assume all are allowed.
     *    LINEAR = 1; // Linear/In-stream
     *    NON_LINEAR = 2; // Non-linear/Overlay
     * @var int
     */
    protected $linearity;

    /**
     * Minimum video ad duration in seconds.
     * RECOMMENDED by the OpenRTB specification.
     *
     * @recommended
     * @var int
     */
    protected $minduration;

    /**
     * Maximum video ad duration in seconds.
     * RECOMMENDED by the OpenRTB specification.
     *
     * @recommended
     * @var int
     */
    protected $maxduration;

    /**
     * NOTE: Use of $protocols instead is highly recommended.
     * @deprecated
     * @var int
     */
    protected $protocol;

    /**
     * Array of supported video bid response protocols.
     * At least one supported protocol must be specified.
     * Examples:
     *  VAST_1_0 = 1;
     *  VAST_2_0 = 2;
     *  VAST_3_0 = 3;
     *
     * Array of integers (VideoBidResponseProtocols)
     * @recommended
     * @var array
     */
    protected $protocols;

    /**
     * Width of the video player in device independent pixels (DIPS).
     * RECOMMENDED by the OpenRTB specification.
     *
     * @recommended
     * @var int
     */
    protected $w;

    /**
     * Height of the video player in device independent pixels (DIPS)
     * RECOMMENDED by the OpenRTB specification.
     *
     * @recommended
     * @var int
     */
    protected $h;

    /**
     * Indicates the start delay in seconds for pre-roll, mid-roll, or post-roll ad placements.
     * Refer to enum StartDelay for generic values.
     * RECOMMENDED by the OpenRTB specification.
     *
     * @recommended
     * @var int
     */
    protected $startdelay;

    /**
     * Indicates if the player will allow the video to be skipped / where 0 = no, 1 = yes.
     * If a bidder sends markup/creative that is itself skippable, the Bid object should include the attr array with an element of 16 indicating skippable video.
     *
     * @var int
     */
    protected $skip;

    /**
     * Videos of total duration greater than this number of seconds can be skippable; only applicable if the ad is skippable.
     *
     * @var int
     */
    protected $skipmin;

    /**
     * Number of seconds a video must play before skipping is enabled; only applicable if the ad is skippable.
     *
     * @var int
     */
    protected $skipafter;

    /**
     * If multiple ad impressions are offered in the same bid request, the sequence number will allow for the coordinated delivery of multiple creatives.[default = 1];
     *
     * @defaults 1
     * @var int
     */
    protected $sequence;

    /**
     * Blocked creative attributes.
     *
     * Array of integers (CreativeAttributes)
     * @var array
     */
    protected $battr;

    /**
     * Maximum extended video ad duration, if extension is allowed.
     * If blank or 0, extension is not allowed.
     * If -1, extension is allowed, and there is no time limit imposed.
     * If greater than 0, then the value represents the number of seconds of extended play supported beyond the maxduration value.
     *
     * @var int
     */
    protected $maxextended;

    /**
     * Minimum bit rate in Kbps.
     * @var int
     */
    protected $minbitrate;

    /**
     * Maximum bit rate in Kbps
     * @var int
     */
    protected $maxbitrate;

    /**
     * Indicates if letter-boxing of 4:3 content into a 16:9 window is allowed, where 0 = no, 1 = yes.
     *
     * @default 1
     * @var int
     */
    protected $boxingallowed;

    /**
     * Playback methods that may be in use.
     * If none are specified, any method may be used.
     * Only one method is typically used in practice.
     * As a result, this array may be converted to an integer in a future version of the specification.
     * It is strongly advised to use only the first element of this array in preparation for this change
     *
     * Array of integers (VideoPlaybackMethods)
     * @var array
     */
    protected $playbackmethod;

    /**
     * Supported delivery methods (e.g., streaming, progressive). If none specified, assume all are supported.
     *
     * Array of integers (ContentDeliveryMethods)
     * @var array
     */
    protected $delivery;

    /**
     * Ad position on screen.
     *
     * AdPosition
     * @var int
     */
    protected $pos;

    /**
     * Array of Banner objects if companion ads are available
     *
     * Array of Banner
     * @var ArrayCollection
     */
    protected $companionad;

    /**
     * List of supported API frameworks for this impression. If an API is not explicitly listed, it is assumed not to be supported.
     *
     * Array of integers (ApiFrameworks)
     * @var array
     */
    protected $api;

    /**
     * Supported VAST companion ad types. Recommended if companion Banner objects are included via the companionad array.
     *
     * Array of integers (VastCompanionTypes)
     * @var array
     */
    protected $companiontype;

    /**
     * Placement type for the impression.
     *
     * @var VideoPlacementType
     */
    protected $placement;

    /**
     * The event that causes playback to end.
     *
     * @var PlaybackCessationMode
     */
    protected $playbackend;

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
        $this->setCompanionad(new ArrayCollection());
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
        $this->validateIn($mimes, VideoMimeType::getAll());
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
    public function getMinduration()
    {
        return $this->minduration;
    }

    /**
     * @param int $minduration
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setMinduration($minduration)
    {
        $this->minduration = $this->validateInt($minduration);
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxduration()
    {
        return $this->maxduration;
    }

    /**
     * @param int $maxduration
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setMaxduration($maxduration)
    {
        $this->maxduration = $this->validateInt($maxduration);
        return $this;
    }

    /**
     * @deprecated
     * @return int
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @param $protocol
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $this->validateInt($protocol);
        return $this;
    }

    /**
     * @return array
     */
    public function getProtocols()
    {
        return $this->protocols;
    }

    /**
     * @param int $protocols
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addProtocols($protocols)
    {
        $this->validateIn($protocols, VideoBidResponseProtocols::getAll());
        $this->protocols[] = $protocols;
        return $this;
    }

    /**
     * @param array $protocols
     * @return $this
     */
    public function setProtocols(array $protocols)
    {
        $this->protocols = $protocols;
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
     * @return int
     */
    public function getStartdelay()
    {
        return $this->startdelay;
    }

    /**
     * @param int $startdelay
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setStartdelay($startdelay)
    {
        $this->startdelay = $this->validateInt($startdelay);
        return $this;
    }

    /**
     * @return int
     */
    public function getLinearity()
    {
        return $this->linearity;
    }

    /**
     * @param int $linearity
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setLinearity($linearity)
    {
        $this->validateIn($linearity, VideoLinearity::getAll());
        $this->linearity = $linearity;
        return $this;
    }

    /**
     * @return int
     */
    public function getSequence()
    {
        return $this->sequence;
    }

    /**
     * @param int $sequence
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setSequence($sequence)
    {
        $this->sequence = $this->validateInt($sequence);
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
    public function getMaxextended()
    {
        return $this->maxextended;
    }

    /**
     * @param int $maxextended
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setMaxextended($maxextended)
    {
        $this->maxextended = $this->validateInt($maxextended);
        return $this;
    }

    /**
     * @return int
     */
    public function getMinbitrate()
    {
        return $this->minbitrate;
    }

    /**
     * @param int $minbitrate
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setMinbitrate($minbitrate)
    {
        $this->minbitrate = $this->validateInt($minbitrate);
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxbitrate()
    {
        return $this->maxbitrate;
    }

    /**
     * @param int $maxbitrate
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setMaxbitrate($maxbitrate)
    {
        $this->maxbitrate = $this->validateInt($maxbitrate);
        return $this;
    }

    /**
     * @return int
     */
    public function getBoxingallowed()
    {
        return $this->boxingallowed;
    }

    /**
     * @param int $boxingallowed
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setBoxingallowed($boxingallowed)
    {
        $this->validateIn($boxingallowed, BitType::getAll());
        $this->boxingallowed = $boxingallowed;
        return $this;
    }

    /**
     * @return array
     */
    public function getPlaybackmethod()
    {
        return $this->playbackmethod;
    }

    /**
     * @param int $playbackmethod
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addPlaybackmethod($playbackmethod)
    {
        $this->validateIn($playbackmethod, VideoPlaybackMethods::getAll());
        $this->playbackmethod[] = $playbackmethod;
        return $this;
    }

    /**
     * @param array $playbackmethod
     * @return $this
     */
    public function setPlaybackmethod(array $playbackmethod)
    {
        $this->playbackmethod = $playbackmethod;
        return $this;
    }

    /**
     * @return array
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * @param int $delivery
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addDelivery($delivery)
    {
        $this->validateIn($delivery, ContentDeliveryMethods::getAll());
        $this->delivery[] = $delivery;
        return $this;
    }

    /**
     * @param array $delivery
     * @return $this
     */
    public function setDelivery(array $delivery)
    {
        $this->delivery = $delivery;
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
     * @return ArrayCollection
     */
    public function getCompanionad()
    {
        return $this->companionad;
    }

    /**
     * @param Banner $companionad
     * @return $this
     */
    public function addCompanionad(Banner $companionad)
    {
        $this->companionad->add($companionad);
        return $this;
    }

    /**
     * @param ArrayCollection $companionad
     * @return $this
     */
    public function setCompanionad(ArrayCollection $companionad)
    {
        $this->companionad = $companionad;
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
     * @return array
     */
    public function getCompaniontype()
    {
        return $this->companiontype;
    }

    /**
     * @param $companiontype
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addCompaniontype($companiontype)
    {
        $this->validateIn($companiontype, VastCompanionTypes::getAll());
        $this->companiontype[] = $companiontype;
        return $this;
    }

    /**
     * @param array $companiontype
     * @return $this
     */
    public function setCompaniontype(array $companiontype)
    {
        $this->companiontype = $companiontype;
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
    public function getSkip()
    {
        return $this->skip;
    }

    /**
     * @param $skip
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setSkip($skip)
    {
        $this->validateIn($skip, BitType::getAll());
        $this->skip = $skip;

        return $this;
    }

    /**
     * @return int
     */
    public function getSkipmin()
    {
        return $this->skipmin;
    }

    /**
     * @param $skipmin
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setSkipmin($skipmin)
    {
        $this->validateInt($skipmin);
        $this->skipmin = $skipmin;

        return $this;
    }

    /**
     * @return int
     */
    public function getSkipafter()
    {
        return $this->skipafter;
    }

    /**
     * @param $skipafter
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setSkipafter($skipafter)
    {
        $this->validateInt($skipafter);
        $this->skipafter = $skipafter;

        return $this;
    }

    /**
     * @return VideoPlacementType
     */
    public function getPlacement()
    {
        return $this->placement;
    }

    /**
     * @param $placement
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setPlacement($placement)
    {
        $this->validateIn($placement, VideoPlacementType::getAll());
        $this->placement = $placement;

        return $this;
    }

    /**
     * @return PlaybackCessationMode
     */
    public function getPlaybackend()
    {
        return $this->playbackend;
    }

    /**
     * @param $playbackend
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setPlaybackend($playbackend)
    {
        $this->validateIn($playbackend, PlaybackCessationMode::getAll());
        $this->playbackend = $playbackend;

        return $this;
    }

}
