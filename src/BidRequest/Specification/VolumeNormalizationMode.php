<?php

namespace OpenRtb\BidRequest\Specification;

use OpenRtb\Tools\Traits\GetConstants;

/**
 * Class VolumeNormalizationMode
 * @package OpenRtb\BidRequest\Specification
 */
class VolumeNormalizationMode
{
    use GetConstants;

    const NONE = 0;
    const AVERAGE_VOLUME = 1;
    const PEAK_VOLUME = 2;
    const LOUDNESS = 3;
    const CUSTOM_VOLUME = 4;
}
