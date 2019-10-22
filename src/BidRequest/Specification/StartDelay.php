<?php
namespace OpenRtb\BidRequest\Specification;

use OpenRtb\Tools\Traits\GetConstants;

class StartDelay
{
    use GetConstants;

    const PRE_ROLL = 0;
    const GENERIC_MID_ROLL = -1;
    const GENERIC_POST_ROLL = -2;
}
