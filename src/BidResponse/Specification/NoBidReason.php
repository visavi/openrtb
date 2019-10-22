<?php

namespace OpenRtb\BidResponse\Specification;

use OpenRtb\Tools\Traits\GetConstants;

class NoBidReason
{
    use GetConstants;

    const UNKNOWN_ERROR = 0;
    const TECHNICAL_ERROR = 1;
    const INVALID_REQUEST = 2;
    const KNOWN_WEB_SPIDER = 3;
    const SUSPECTED_NON_HUMAN_TRAFFIC = 4;
    const CLOUD_DATA_CENTER_PROXY_IP = 5;
    const UNSUPPORTED_DEVICE = 6;
    const BLOCKED_PUBLISHER_SITE = 7;
    const UNMATCHED_USER = 8;
}
