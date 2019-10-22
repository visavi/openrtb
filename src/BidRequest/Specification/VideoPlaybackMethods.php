<?php

namespace OpenRtb\BidRequest\Specification;

use OpenRtb\Tools\Traits\GetConstants;

/**
 * http://www.iab.net/media/file/OpenRTB-API-Specification-Version-2-3.pdf - 5.9
 * Class VideoPlaybackMethods
 * @package OpenRtb\BidRequest\Specification
 */
class VideoPlaybackMethods
{
    use GetConstants;

    const AUTO_PLAY_SOUND_ON = 1;
    // Initiates on Page Load with Sound Off by Default.
    const AUTO_PLAY_SOUND_OFF = 2;
    // Initiates on Click with Sound On.
    const CLICK_TO_PLAY = 3;
    // Initiates on Mouse-Over with Sound On.
    const MOUSE_OVER = 4;
    // Initiates on Entering Viewport with Sound On.
    const ENTER_SOUND_ON = 5;
    // Initiates on Entering Viewport with Sound Off by Default.
    const ENTER_SOUND_OFF = 6;
}
