<?php

namespace OpenRtb\BidRequest\Specification;

use OpenRtb\Tools\Traits\GetConstants;

/**
 * Class FeedType
 * @package OpenRtb\BidRequest\Specification
 */
class FeedType
{
    use GetConstants;

    const MUSIC_SERVICE = 1;
    const BROADCAST = 2;
    const PODCAST = 3;
}
