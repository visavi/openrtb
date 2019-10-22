<?php

namespace OpenRtb\BidRequest;

use OpenRtb\BidRequest\Specification\ApiFrameworks;
use OpenRtb\BidRequest\Specification\BitType;
use OpenRtb\BidRequest\Specification\ContentDeliveryMethods;
use OpenRtb\BidRequest\Specification\CreativeAttributes;
use OpenRtb\BidRequest\Specification\FeedType;
use OpenRtb\BidRequest\Specification\VastCompanionTypes;
use OpenRtb\BidRequest\Specification\VideoBidResponseProtocols;
use OpenRtb\BidRequest\Specification\VideoMimeType;
use OpenRtb\BidRequest\Specification\VolumeNormalizationMode;
use OpenRtb\Tools\Interfaces\Arrayable;
use OpenRtb\Tools\Traits\SetterValidation;
use OpenRtb\Tools\Traits\ToArray;
use OpenRtb\Tools\Classes\ArrayCollection;

class Audio implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * Content MIME types supported (e.g., "audio/mp4")
     * REQUIRED by the OpenRTB specification: at least 1 element.
     *
     * Array of strings
     * @required
     * @var array
     */
    protected $mimes;

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
     * Array of supported video bid response protocols. At least one supported protocol must be specified.
     * Examples:
     *  DAAST_1_0 = 9;
     *  DAAST_1_0_WRAPPER = 10;
     *
     * Array of integers (VideoBidResponseProtocols)
     * @recommended
     * @var array
     */
    protected $protocols;

    /**
     * Indicates the start delay in seconds for pre-roll, mid-roll, or post-roll ad placements. Refer to enum StartDelay for generic values.
     * @recommended
     * @var int
     */
    protected $startdelay;

    /**
     * If multiple ad impressions are offered in the same bid request, the sequence number will allow for the coordinated delivery of multiple creatives
     * @default 1
     * @var int
     */
    protected $sequence;

    /**
     * Blocked creative attributes
     * Array of integers (CreativeAttributes)
     * @var array
     */
    protected $battr;

    /**
     * Maximum extended video ad duration, if extension is allowed. If blank or 0, extension is not allowed.
     * If -1, extension is allowed, and there is no time limit imposed.
     * If greater than 0, the value represents the number of seconds of extended play supported beyond the maxduration value
     *
     * @var int
     */
    protected $maxextended;

    /**
     * Minimum bit rate in Kbps
     * @var int
     */
    protected $minbitrate;

    /**
     * Maximum bit rate in Kbps
     * @var int
     */
    protected $maxbitrate;

    /**
     * Supported delivery methods
     * Array of integers (ContentDeliveryMethods)
     * @var array
     */
    protected $delivery;

       /**
     * Array of Banner
     * @var ArrayCollection
     */
    protected $companionad;

    /**
     * Array of integers (ApiFrameworks)
     * @var array
     */
    protected $api;

    /**
     * Array of integers (VastCompanionTypes)
     * @var array
     */
    protected $companiontype;


    /**
     * The maximum number of ads that can be played in an ad pod.
     *
     * @var int
     */
    protected $maxseq;

    /**
     * Type of audio feed.
     *
     * @var FeedType
     */
    protected $feed;

    /**
     * Indicates if the ad is stitched with audio content or delivered independently, where 0 = no, 1 = yes.
     *
     * @var int
     */
    protected $stitched;

    /**
     * Volume normalization mode.
     *
     * @var VolumeNormalizationMode
     */
    protected $nvol;


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
     * @deprecated
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
    public function getMaxseq()
    {
        return $this->maxseq;
    }

    /**
     * @param $maxseq
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setMaxseq($maxseq)
    {
        $this->validateInt($maxseq);
        $this->maxseq = $maxseq;

        return $this;
    }

    /**
     * @return FeedType
     */
    public function getFeed()
    {
        return $this->feed;
    }

    /**
     * @param $feed
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setFeed($feed)
    {
        $this->validateIn($feed, FeedType::getAll());
        $this->feed = $feed;

        return $this;
    }

    /**
     * @return int
     */
    public function getStitched()
    {
        return $this->stitched;
    }

    /**
     * @param $stitched
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setStitched($stitched)
    {
        $this->validateIn($stitched, BitType::getAll());
        $this->stitched = $stitched;

        return $this;
    }

    /**
     * @return VolumeNormalizationMode
     */
    public function getNvol()
    {
        return $this->nvol;
    }

    /**
     * @param $nvol
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setNvol($nvol)
    {
        $this->validateIn($nvol, VolumeNormalizationMode::getAll());
        $this->nvol = $nvol;

        return $this;
    }


}
