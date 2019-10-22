<?php

namespace OpenRtb\BidRequest\Specification;

use OpenRtb\Tools\Traits\GetConstants;

class ExpandableDirection
{
    use GetConstants;
    const LEFT = 1;
    const RIGHT = 2;
    const UP = 3;
    const DOWN = 4;
    const EXPANDABLE_FULLSCREEN = 5;
}
