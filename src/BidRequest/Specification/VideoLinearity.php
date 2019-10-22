<?php

namespace OpenRtb\BidRequest\Specification;

use OpenRtb\Tools\Traits\GetConstants;

/**
 * http://www.iab.net/media/file/OpenRTB-API-Specification-Version-2-3.pdf - 5.7
 * Class VideoLinearity
 * @package OpenRtb\BidRequest\Specification
 */
class VideoLinearity
{
    use GetConstants;

    const LINEAR_IN_STREAM = 1;
    const NON_LINEAR_OVERLAY = 2;
}
