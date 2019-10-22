<?php

namespace OpenRtb\BidRequest\Specification;


use OpenRtb\Tools\Traits\GetConstants;

class AdPosition
{
    use GetConstants;

    const UNKNOWN = 0;
    const ABOVE_THE_FOLD = 1;
    const DEPRECATED_LIKELY_BELOW_THE_FOLD = 2; // May or may not be initially visible depending on screen size/resolution.
    const BELOW_THE_FOLD = 3;
    const HEADER = 4;
    const FOOTER = 5;
    const SIDEBAR = 6;
    const AD_POSITION_FULLSCREEN = 7;
}
