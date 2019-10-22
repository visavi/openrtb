<?php

namespace OpenRtb\BidRequest\Specification;

use OpenRtb\Tools\Traits\GetConstants;

class LocationType
{
    use GetConstants;

    const GPS = 1;
    const IP_ADDRESS = 2;
    const USER_PROVIDED = 3;
}
