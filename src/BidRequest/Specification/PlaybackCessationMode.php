<?php

namespace OpenRtb\BidRequest\Specification;

use OpenRtb\Tools\Traits\GetConstants;

/**
 * Class PlaybackCessationMode
 * @package OpenRtb\BidRequest\Specification
 */
class PlaybackCessationMode
{
    use GetConstants;

    // On Video Completion or when Terminated by User
    const COMPLETION_OR_USER = 1;

    // On Leaving Viewport or when Terminated by User
    const LEAVING_OR_USER = 2;

    // On Leaving Viewport Continues as a Floating/Slider Unit until
    // Video Completion or when Terminated by User
    const LEAVING_CONTINUES_OR_USER = 3;
}
