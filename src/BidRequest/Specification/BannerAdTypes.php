<?php

namespace OpenRtb\BidRequest\Specification;

use OpenRtb\Tools\Traits\GetConstants;

/**
 * http://www.iab.net/media/file/OpenRTB-API-Specification-Version-2-3.pdf - 5.2
 * Class BannerAdTypes
 * @package OpenRtb\BidRequest\Specification
 */
class BannerAdTypes
{
    use GetConstants;

    const XHTML_TEXT_AD = 1;
    const XHTML_BANNER_AD = 2;
    const JAVASCRIPT_AD = 3;
    const IFRAME = 4;
}
