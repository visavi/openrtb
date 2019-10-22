<?php

namespace OpenRtb\BidRequest\Specification;

use OpenRtb\Tools\Traits\GetConstants;

/**
 * http://www.iab.net/media/file/OpenRTB-API-Specification-Version-2-3.pdf - 5.3
 * Class CreativeAttributes
 * @package OpenRtb\BidRequest\Specification
 */
class CreativeAttributes
{
    use GetConstants;

    const AUDIO_AUTO_PLAY = 1;
    const AUDIO_USER_INITIATED = 2;
    const EXPANDABLE_AUTOMATIC = 3;
    const EXPANDABLE_CLICK_INITIATED = 4;
    const EXPANDABLE_ROLLOVER_INITIATED = 5;
    const VIDEO_IN_BANNER_AUTO_PLAY = 6;
    const VIDEO_IN_BANNER_USER_INITIATED = 7;
    const POP = 8;  // Pop (e.g., Over, Under, or upon Exit).
    const PROVOCATIVE_OR_SUGGESTIVE = 9;
    // Defined as "Shaky, Flashing, Flickering, Extreme Animation, Smileys".
    const ANNOYING = 10;
    const SURVEYS = 11;
    const TEXT_ONLY = 12;
    const USER_INTERACTIVE = 13;  // Eg, embedded games.
    const WINDOWS_DIALOG_OR_ALERT_STYLE = 14;
    const HAS_AUDIO_ON_OFF_BUTTON = 15;
    const AD_CAN_BE_SKIPPED = 16;
    const FLASH = 17;
}
