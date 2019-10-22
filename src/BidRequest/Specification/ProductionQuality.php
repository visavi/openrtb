<?php

namespace OpenRtb\BidRequest\Specification;

use OpenRtb\Tools\Traits\GetConstants;

/**
 * Class VideoPlacementType
 * @package OpenRtb\BidRequest\Specification
 */
class ProductionQuality
{
    use GetConstants;

    const QUALITY_UNKNOWN = 0;
    const PROFESSIONAL = 1;
    const PROSUMER = 2;
    const USER_GENERATED = 3;
}
