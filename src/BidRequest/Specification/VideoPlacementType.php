<?php

namespace OpenRtb\BidRequest\Specification;

use OpenRtb\Tools\Traits\GetConstants;

/**
 * Class VideoPlacementType
 * @package OpenRtb\BidRequest\Specification
 */
class VideoPlacementType
{
    use GetConstants;

    // The video placement is not defined.
    // Default value.
    const UNDEFINED_VIDEO_PLACEMENT = 0;

    // Played before, during or after the streaming video content
    // that the consumer has requested.
    // E.G.: Pre-roll, Mid-roll, Post-roll.
    const IN_STREAM_PLACEMENT = 1;

    // Exists within a web banner that leverages the banner space
    // to deliver a video experience as opposed to another static
    // or rich media format.
    // The format relies on the existence of display ad inventory
    // on the page for its delivery.
    const IN_BANNER_PLACEMENT = 2;

    // Loads and plays dynamically between paragraphs of editorial content;
    // existing as a standalone branded message.
    const IN_ARTICLE_PLACEMENT = 3;

    // In-Feed - Found in content, social, or product feeds.
    const IN_FEED_PLACEMENT = 4;

    // Interstitial/Slider/Floating.
    // Covers the entire or a portion of screen area,
    // but is always on screen while displayed
    // (i.e. cannot be scrolled out of view).
    // Note that a full-screen interstitial (e.g., in mobile)
    // can be distinguished from a floating/slider unit by the imp.instl field.
    const FLOATING_PLACEMENT = 5;
}
