<?php

namespace OpenRtb\BidRequest\Specification;

use OpenRtb\Tools\Traits\GetConstants;

class QagMediaRatings
{
    use GetConstants;

    const ALL_AUDIENCES = 1;
    const EVERYONE_OVER_12 = 2;
    const MATURE_AUDIENCES = 3;
}
