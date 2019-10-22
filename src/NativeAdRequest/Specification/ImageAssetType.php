<?php

namespace OpenRtb\NativeAdRequest\Specification;

use OpenRtb\Tools\Traits\GetConstants;

class ImageAssetType
{
    use GetConstants;

    const ICON = 1;
    const LOGO = 2;
    const MAIN = 3;
    // 500+ XXX Reserved for Exchange specific usage numbered above 500
}
