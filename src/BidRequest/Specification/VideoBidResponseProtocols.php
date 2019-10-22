<?php

namespace OpenRtb\BidRequest\Specification;

use OpenRtb\Tools\Traits\GetConstants;

/**
 * http://www.iab.net/media/file/OpenRTB-API-Specification-Version-2-3.pdf - 5.8
 * Class VideoBidResponseProtocols
 * @package OpenRtb\BidRequest\Specification
 */
class VideoBidResponseProtocols
{
    use GetConstants;

    const VAST_1_0 = 1;
    const VAST_2_0 = 2;
    const VAST_3_0 = 3;
    const VAST_1_0_WRAPPER = 4;
    const VAST_2_0_WRAPPER = 5;
    const VAST_3_0_WRAPPER = 6;
    const VAST_4_0 = 7;
    const VAST_4_0_WRAPPER = 8;
    const DAAST_1_0 = 9;
    const DAAST_1_0_WRAPPER = 10;
}
