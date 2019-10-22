<?php

namespace OpenRtb\BidRequest\Specification;


use OpenRtb\Tools\Traits\GetConstants;

class Gender
{
    use GetConstants;

    const MALE = 'M';
    const FEMALE = 'F';
    const KNOWN_TO_BE_OTHER = 'O';
    const UNKNOWN = null;
}
