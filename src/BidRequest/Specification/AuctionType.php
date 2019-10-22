<?php

namespace OpenRtb\BidRequest\Specification;

use OpenRtb\Tools\Traits\GetConstants;

class AuctionType
{
    use GetConstants;
    const FIRST_PRICE = 1;
    const SECOND_PRICE = 2;
    const FIXED_PRICE = 3;
}
