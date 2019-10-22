<?php

namespace OpenRtb\BidRequest\Specification;

use OpenRtb\Tools\Traits\GetConstants;

class ContentContext
{
    use GetConstants;

    const VIDEO = 1;
    const GAME = 2;
    const MUSIC = 3;
    const APPLICATION = 4;
    const TEXT = 5;
    const OTHER = 6;
    const UNKNOWN = 7;
}
