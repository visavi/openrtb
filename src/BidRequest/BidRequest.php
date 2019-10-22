<?php

namespace OpenRtb\BidRequest;

use OpenRtb\BidRequest\Specification\BitType;
use OpenRtb\Tools\Interfaces\Arrayable;
use OpenRtb\Tools\Traits\SetterValidation;
use OpenRtb\Tools\Traits\ToArray;
use OpenRtb\Tools\Classes\ArrayCollection;

class BidRequest implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * Unique ID of the bid request, provided by the exchange.ç
     * OpenRTB is websafe base64 (no padding).
     * @required
     * @var string
     */
    protected $id;

    /**
     * Representing the impressions offered.
     * At least 1 Imp object is required.
     * @required
     * @var ArrayCollection
     */
    protected $imp;

    /**
     * Details about the publisher's website.
     * Only applicable and recommended for websites.
     * One off with app.
     * @recommended
     * @var Site
     */
    protected $site;

    /**
     * Details about the publisher's app.
     * (non-browser applications). Only applicable and recommended for apps.
     * One off with site.
     * @recommended
     * @var App
     */
    protected $app;

    /**
     * Details about the user's device to which the impression will be delivered.
     * @recommended
     * @var Device
     */
    protected $device;

    /**
     * Details about the human user of the device; the advertising audience.
     * @recommended
     * @var User
     */
    protected $user;

    /**
     * Indicator of test mode in which auctions are not billable,
     * where 0 = live mode, 1 = test mode
     * @default 0
     * @var int
     */
    protected $test;

    /**
     * where 1 = First Price, 2 = Second Price Plus. Exchange-specific auction types can be defined using values > 500. Default = SECOND_PRICE.
     * Auction type, where 1 = First Price, 2 = Second Price Plus
     * @default 2
     * @var int
     */
    protected $at;

    /**
     * Maximum time in milliseconds to submit a bid to avoid timeout
     * @var int
     */
    protected $tmax;

    /**
     * Whitelist of buyer seats (e.g., advertisers, agencies) allowed to bid on this impression.
     * IDs of seats and knowledge of the buyer's customers to which they refer must be coordinated between bidders and the exchange a priori.
     * Omission implies no seat restrictions.
     *
     * @var string
     */
    protected $wseat;

    /**
     * Flag to indicate if Exchange can verify that the impressions offered represent all of the impressions available in context
     * (e.g., all on the web page, all video spots such as pre/mid/post roll) to support road-blocking.
     * 0 = no or unknown, 1 = yes,
     * the impressions offered represent all that are available.
     * @default 0
     * @var int
     */
    protected $allimps;

    /**
     * Array of allowed currencies for bids on this bid request using ISO-4217 alpha codes.
     * Recommended only if the exchange accepts multiple currencies.
     * Array of strings
     * @var array
     */
    protected $cur;

    /**
     * Blocked advertiser categories using the IAB content categories. Refer to enum ContentCategory.
     * Array of strings
     * @var array
     */
    protected $bcat;

    /**
     * Block list of advertisers by their domains (e.g., "ford.com")
     * Array of strings
     * @var array
     */
    protected $badv;

    /**
     * Block list of applications by their platform-specific exchange-independent application identifiers.
     * On Android, these should be bundle or package names (e.g., com.foo.mygame). On iOS, these are numeric IDs.
     * Array of strings
     * @var array
     */
    protected $bapp;

    /**
     * Specifies any industry, legal, or governmental regulations in force for this request.
     * @var Regs
     */
    protected $regs;

    /**
     * Block list of buyer seats (e.g., advertisers, agencies) restricted from bidding on this impression.
     * IDs of seats and knowledge of the buyer's customers to which they refer must be coordinated between bidders and the exchange a priori.
     * At most, only one of wseat and bseat should be used in the same request. Omission of both implies no seat restrictions.
     *
     * @var string
     */
    protected $bseat;

    /**
     * Whitelist of languages for creatives using ISO-639-1-alpha-2. Omission implies no specific restrictions,
     * but buyers would be advised to consider language attribute in the Device and/or Content objects if available.
     *
     * @var string
     */
    protected $wlang;

    /**
     * A Source object that provides data about the inventory source and which entity makes the final decision.
     * @var Source
     */
    protected $source;

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
        $this->setImp(new ArrayCollection());
        $this->setSite(new Site());
        $this->setApp(new App());
        $this->setDevice(new Device());
        $this->setUser(new User());
        $this->setRegs(new Regs());
        $this->setSource(new Source());
    }

    /**
     * @return false|string
     * @throws \OpenRtb\Tools\Exceptions\ExceptionMissingRequiredField
     */
    public function getBidRequest()
    {
        return json_encode($this->toArray());
    }

    /**
     * @return false|string
     * @throws \OpenRtb\Tools\Exceptions\ExceptionMissingRequiredField
     */
    public function getRequest()
    {
        return $this->getBidRequest();
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
     * @param ArrayCollection $imp
     * @return $this
     */
    public function setImp(ArrayCollection $imp)
    {
        $this->imp = $imp;
        return $this;
    }

    /**
     * @param Imp $imp
     * @return $this
     */
    public function addImp(Imp $imp = null)
    {
        if (is_null($imp)) {
            $imp = new Imp();
        }
        $this->imp->add($imp);
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getImp()
    {
        return $this->imp;
    }

    /**
     * @return Site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param Site $site
     * @return $this
     */
    public function setSite(Site $site)
    {
        $this->site = $site;
        return $this;
    }

    /**
     * @return App
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @param App $app
     * @return $this
     */
    public function setApp(App $app)
    {
        $this->app = $app;
        return $this;
    }

    /**
     * @return Device
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * @param Device $device
     * @return $this
     */
    public function setDevice(Device $device)
    {
        $this->device = $device;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return Regs
     */
    public function getRegs()
    {
        return $this->regs;
    }

    /**
     * @param Regs $regs
     * @return $this
     */
    public function setRegs(Regs $regs)
    {
        $this->regs = $regs;
        return $this;
    }

    /**
     * @return int
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * @param $test
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setTest($test)
    {
        $this->validateIn($test, BitType::getAll());
        $this->test = $test;
        return $this;
    }

    /**
     * @return int
     */
    public function getAt()
    {
        return $this->at;
    }

    /**
     * @param $at
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setAt($at)
    {
        $this->at = $this->validateInt($at);
        return $this;
    }

    /**
     * @return int
     */
    public function getTmax()
    {
        return $this->tmax;
    }

    /**
     * @param int $tmax
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setTmax($tmax)
    {
        $this->tmax = $this->validatePositiveInt($tmax);
        return $this;
    }

    /**
     * @return string
     */
    public function getWseat()
    {
        return $this->wseat;
    }

    /**
     * @param string $wseat
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addWseat($wseat)
    {
        $this->validateString($wseat);
        $this->wseat = $wseat;
        return $this;
    }

    /**
     * @param array $wseat
     * @return $this
     */
    public function setWseat(array $wseat)
    {
        $this->wseat = $wseat;
        return $this;
    }

    /**
     * @return int
     */
    public function getAllimps()
    {
        return $this->allimps;
    }

    /**
     * @param int $allimps
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setAllimps($allimps)
    {
        $this->validateIn($allimps, BitType::getAll());
        $this->allimps = $allimps;
        return $this;
    }

    /**
     * @return array
     */
    public function getCur()
    {
        return $this->cur;
    }

    /**
     * @param string $cur
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addCur($cur)
    {
        $this->validateString($cur);
        $this->cur[] = $cur;
        return $this;
    }

    /**
     * @param array $cur
     * @return $this
     */
    public function setCur(array $cur)
    {
        $this->cur = $cur;
        return $this;
    }

    /**
     * @return array
     */
    public function getBcat()
    {
        return $this->bcat;
    }

    /**
     * @param string $bcat
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addBcat($bcat)
    {
        $this->validateString($bcat);
        $this->bcat[] = $bcat;
        return $this;
    }

    /**
     * @param array $bcat
     * @return $this
     */
    public function setBcat(array $bcat)
    {
        $this->bcat = $bcat;
        return $this;
    }

    /**
     * @return array
     */
    public function getBadv()
    {
        return $this->badv;
    }

    /**
     * @param string $badv
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addBadv($badv)
    {
        $this->validateString($badv);
        $this->badv[] = $badv;
        return $this;
    }

    /**
     * @param array $badv
     * @return $this
     */
    public function setBadv(array $badv)
    {
        $this->badv = $badv;
        return $this;
    }

    /**
     * @param string $bapp
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addBapp($bapp)
    {
        $this->validateString($bapp);
        $this->bapp[] = $bapp;
        return $this;
    }

    /**
     * @param array $bapp
     * @return $this
     */
    public function setBapp(array $bapp)
    {
        $this->bapp = $bapp;
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
     * @param string $bseat
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addBseat($bseat)
    {
        $this->validateString($bseat);
        $this->bseat = $bseat;
        return $this;
    }

    /**
     * @param array $bseat
     * @return $this
     */
    public function setBseat(array $bseat)
    {
        $this->bseat = $bseat;
        return $this;
    }

    /**
     * @param string $wlang
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addWlang($wlang)
    {
        $this->validateString($wlang);
        $this->wlang = $wlang;
        return $this;
    }

    /**
     * @param array $wlang
     * @return $this
     */
    public function setWlang(array $wlang)
    {
        $this->wlang = $wlang;
        return $this;
    }


    /**
     * @return Source
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param Source $source
     * @return $this
     */
    public function setSource(Source $source)
    {
        $this->source = $source;
        return $this;
    }
}
