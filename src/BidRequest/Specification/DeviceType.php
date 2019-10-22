<?php

namespace OpenRtb\BidRequest\Specification;

use OpenRtb\Tools\Traits\GetConstants;

class DeviceType
{
    use GetConstants;

    const MOBILE_TABLET = 1;
    const PERSONAL_COMPUTER = 2;
    const CONNECTED_TV = 3;
    const PHONE = 4;
    const TABLET = 5;
    const CONNECTED_DEVICE = 6;
    const SET_TOP_BOX = 7;
}
