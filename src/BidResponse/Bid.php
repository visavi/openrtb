<?php

namespace OpenRtb\BidResponse;

use OpenRtb\BidRequest\Specification\ApiFrameworks;
use OpenRtb\BidRequest\Specification\CreativeAttributes;
use OpenRtb\BidRequest\Specification\QagMediaRatings;
use OpenRtb\BidRequest\Specification\VideoBidResponseProtocols;
use OpenRtb\NativeAdResponse\NativeAdResponse;
use OpenRtb\Tools\Interfaces\Arrayable;
use OpenRtb\Tools\Traits\SetterValidation;
use OpenRtb\Tools\Traits\ToArray;

class Bid implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * ID of the bid request to which this is a response.
     *
     * @required
     * @var string
     */
    protected $id;

    /**
     * ID of the Imp object in the related bid request
     *
     * @required
     * @var string
     */
    protected $impid;

    /**
     * Bid price expressed as CPM although the actual transaction is for a unit impression only.
     * Note that while the type indicates float, integer math is highly recommended when handling currencies (e.g., BigDecimal in Java).
     *
     * @required
     * @var float
     */
    protected $price;

    /**
     * ID of a preloaded ad to be served if the bid wins.
     *
     * @var string
     */
    protected $adid;

    /**
     * Win notice URL called by the exchange if the bid wins; optional means of serving ad markup.
     * DoubleClick doesn't support win notices; use %%WINNING_PRICE%% in snippet's impression URL, or ${AUCTION_PRICE}.
     *
     * @var string
     */
    protected $nurl;

    /**
     * Optional means of conveying ad markup in case the bid wins;
     * supercedes the win notice if markup is included in both.
     * For native ad bids, exactly one of {adm, adm_native} should be used; this is the OpenRTB-compliant field for JSON serialization.
     *
     * @var string
     */
    protected $adm;

    /**
     * Native ad response. For native ad bids, exactly one of {adm, adm_native} should be used; this is the field used for Protobuf serialization.
     *
     * @var NativeAdResponse
     */
    protected $adm_native;

    /**
     * Advertiser domain for block list checking (e.g., "ford.com"). This can be an array for the case of rotating creatives.
     * Exchanges can mandate that only one domain is allowed.
     * The OpenRTB spec only allows domain names in adomain; Authorized Buyers support full URLs too.
     * Note this must be a crawlable domain or URL.
     * For native ads, we recommend using BidResponse.seatbid[].bid[].adm_native.link.url instead of adomain.
     *
     * Array of strings
     * @var array
     */
    protected $adomain;

    /**
     * A platform-specific application identifier intended to be unique to the app and independent of the exchange.
     * On Android, this should be a bundle or package name (e.g., com.foo.mygame). On iOS, it is a numeric ID.
     *
     * @var string
     */
    protected $bundle;

    /**
     * URL without cache-busting to an image that is representative of the content of the campaign for ad quality/safety checking.
     *
     * @var string
     */
    protected $iurl;

    /**
     * Campaign ID to assist with ad quality checking; the collection of creatives for which iurl should be representative.
     * Matches the billing ID in the pretargeting. If not set to one of the buyer's billing_id, the bid response is considered invalid.
     * When submitting creatives, a cid is required in the response if more than one billing_id is specified in the request.
     *
     * @var string
     */
    protected $cid;

    /**
     * Creative ID to assist with ad quality checking
     * @var string
     */
    protected $crid;

    /**
     * IAB content categories of the creative
     * Array of strings
     * @var array
     */
    protected $cat;

    /**
     * Set of attributes describing the creative. Can be declared in OpenRTB as bid.attr (OpenRTB), or bid.ext.attribute (AdX).
     *
     * Array of integers
     * @var array
     */
    protected $attr;

    /**
     * API required by the markup if applicable.
     *
     * @var int
     */
    protected $api;

    /**
     * Video response protocol of the markup if applicable.
     *
     * @var int
     */
    protected $protocol;

    /**
     * Creative media rating per QAG guidelines.
     *
     * @var int
     */
    protected $qagmediarating;

    /**
     * Reference to the deal.id from the bid request if this bid pertains to a private marketplace direct deal
     * @var string
     */
    protected $dealid;

    /**
     * Width of the creative in pixels
     * @var int
     */
    protected $w;

    /**
     * Height of the creative in pixels
     * @var int
     */
    protected $h;

    /**
     * Advisory as to the number of seconds the bidder is willing to wait between the auction and the actual impression.
     *
     * @var int
     */
    protected $exp;

    /**
     * Billing notice URL called by the exchange when a winning bid becomes billable based on exchange-specific business policy (e.g., typically delivered, viewed, etc.).
     * Substitution macros can be used. Note that BidExt.impression_tracking_url accepts a repeated list of billing notice URLs.
     * If your use case requires more than one billing URL, use that extension instead of burl.
     *
     * @var string
     */
    protected $burl;

    /**
     * Loss notice URL called by the exchange when a bid is known to have been lost. Substitution macros can be used.
     * Exchange-specific policy may preclude support for loss notices or the disclosure of winning clearing prices resulting in ${AUCTION_PRICE} macros being removed
     * (i.e., replaced with a zero-length string).
     *
     * @var string
     */
    protected $lurl;

    /**
     * Tactic ID to enable buyers to label bids for reporting to the exchange the tactic through which their bid was submitted.
     * The specific usage and meaning of the tactic ID should be communicated between buyer and exchanges a priori.
     *
     * @var string
     */
    protected $tactic;

    /**
     * Language of the creative using ISO-639-1-alpha-2. The nonstandard code "xx" may also be used if the creative has no linguistic content (e.g., a banner with just a company logo).
     *
     * @var string
     */
    protected $language;

    /**
     * Relative width of the creative when expressing size as a ratio. Required for Flex Ads.
     *
     * @var int
     */
    protected $wratio;

    /**
     * Relative height of the creative when expressing size as a ratio. Required for Flex Ads.
     *
     * @var int
     */
    protected $hratio;

    /**
     * @var Ext
     */
    protected $ext;

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
     * @return string
     */
    public function getImpid()
    {
        return $this->impid;
    }

    /**
     * @param string $impid
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setImpid($impid)
    {
        $this->validateString($impid);
        $this->impid = $impid;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setPrice($price)
    {
        $this->price = $this->validateNumericToFloat($price);
        return $this;
    }

    /**
     * @return string
     */
    public function getAdid()
    {
        return $this->adid;
    }

    /**
     * @param string $adid
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setAdid($adid)
    {
        $this->validateString($adid);
        $this->adid = $adid;
        return $this;
    }

    /**
     * @return string
     */
    public function getNurl()
    {
        return $this->nurl;
    }

    /**
     * @param string $nurl
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setNurl($nurl)
    {
        $this->validateString($nurl);
        $this->nurl = $nurl;
        return $this;
    }

    /**
     * @return string
     */
    public function getAdm()
    {
        return $this->adm;
    }

    /**
     * @param string $adm
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setAdm($adm)
    {
        $this->validateString($adm);
        $this->adm = $adm;
        return $this;
    }

    /**
     * @return array
     */
    public function getAdomain()
    {
        return $this->adomain;
    }

    /**
     * @param string $adomain
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addAdomain($adomain)
    {
        $this->validateString($adomain);
        $this->adomain[] = $adomain;
        return $this;
    }

    /**
     * @param array $adomain
     * @return $this
     */
    public function setAdomain(array $adomain)
    {
        $this->adomain = $adomain;
        return $this;
    }

    /**
     * @return string
     */
    public function getBundle()
    {
        return $this->bundle;
    }

    /**
     * @param string $bundle
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setBundle($bundle)
    {
        $this->validateString($bundle);
        $this->bundle = $bundle;
        return $this;
    }

    /**
     * @return string
     */
    public function getIurl()
    {
        return $this->iurl;
    }

    /**
     * @param string $iurl
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setIurl($iurl)
    {
        $this->validateString($iurl);
        $this->iurl = $iurl;
        return $this;
    }

    /**
     * @return string
     */
    public function getCid()
    {
        return $this->cid;
    }

    /**
     * @param string $cid
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setCid($cid)
    {
        $this->validateString($cid);
        $this->cid = $cid;
        return $this;
    }

    /**
     * @return string
     */
    public function getCrid()
    {
        return $this->crid;
    }

    /**
     * @param string $crid
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setCrid($crid)
    {
        $this->validateString($crid);
        $this->crid = $crid;
        return $this;
    }

    /**
     * @return array
     */
    public function getCat()
    {
        return $this->cat;
    }

    /**
     * @param string $cat
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addCat($cat)
    {
        $this->validateString($cat);
        $this->cat = $cat;
        return $this;
    }

    /**
     * @param array $cat
     * @return $this
     */
    public function setCat(array $cat)
    {
        $this->cat = $cat;
        return $this;
    }

    /**
     * @return array
     */
    public function getAttr()
    {
        return $this->attr;
    }

    /**
     * @param int $attr
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addAttr($attr)
    {
        $this->validateIn($attr, CreativeAttributes::getAll());
        $this->attr = $attr;
        return $this;
    }

    /**
     * @param array $attr
     * @return $this
     */
    public function setAttr(array $attr)
    {
        $this->attr = $attr;
        return $this;
    }

    /**
     * @return string
     */
    public function getDealid()
    {
        return $this->dealid;
    }

    /**
     * @param string $dealid
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setDealid($dealid)
    {
        $this->validateString($dealid);
        $this->dealid = $dealid;
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
    public function setExt($ext)
    {
        $this->ext = $ext;
        return $this;
    }

    /**
     * @return NativeAdResponse
     */
    public function getAdmNative()
    {
        return $this->adm_native;
    }

    /**
     * @param NativeAdResponse $adm_native
     * @return $this
     */
    public function setAdmNative(NativeAdResponse $adm_native)
    {
        $this->adm_native = $adm_native;
        return $this;
    }

    /**
     * @return int
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * @param $api
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setApi($api)
    {
        $this->validateIn($api, ApiFrameworks::getAll());
        $this->api = $api;
        return $this;
    }

    /**
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
        $this->validateIn($protocol, VideoBidResponseProtocols::getAll());
        $this->protocol = $protocol;
        return $this;
    }

    /**
     * @return int
     */
    public function getQagmediarating()
    {
        return $this->qagmediarating;
    }

    /**
     * @param $qagmediarating
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setQagmediarating($qagmediarating)
    {
        $this->validateIn($qagmediarating, QagMediaRatings::getAll());
        $this->qagmediarating = $qagmediarating;
        return $this;
    }

    /**
     * @return int
     */
    public function getExp()
    {
        return $this->exp;
    }

    /**
     * @param $exp
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
     * @return string
     */
    public function getBurl()
    {
        return $this->burl;
    }

    /**
     * @param $burl
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setBurl($burl)
    {
        $this->validateString($burl);
        $this->burl = $burl;
        return $this;
    }

    /**
     * @return string
     */
    public function getLurl()
    {
        return $this->lurl;
    }

    /**
     * @param $lurl
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setLurl($lurl)
    {
        $this->validateString($lurl);
        $this->lurl = $lurl;
        return $this;
    }

    /**
     * @return string
     */
    public function getTactic()
    {
        return $this->tactic;
    }

    /**
     * @param $tactic
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setTactic($tactic)
    {
        $this->validateString($tactic);
        $this->tactic = $tactic;

        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param $language
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setLanguage($language)
    {
        $this->validateString($language);
        $this->language = $language;
        return $this;
    }

    /**
     * @return int
     */
    public function getWratio()
    {
        return $this->wratio;
    }

    /**
     * @param $wratio
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setWratio($wratio)
    {
        $this->validateInt($wratio);
        $this->wratio = $wratio;
        return $this;
    }

    /**
     * @return int
     */
    public function getHratio()
    {
        return $this->hratio;
    }

    /**
     * @param $hratio
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setHratio($hratio)
    {
        $this->validateInt($hratio);
        $this->hratio = $hratio;
        return $this;
    }



}
