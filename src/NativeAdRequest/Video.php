<?php

namespace OpenRtb\NativeAdRequest;

use OpenRtb\BidRequest\Specification\VideoBidResponseProtocols;
use OpenRtb\NativeAdRequest\Specification\VideoMimeType;
use OpenRtb\Tools\Interfaces\Arrayable;
use OpenRtb\Tools\Traits\SetterValidation;
use OpenRtb\Tools\Traits\ToArray;

class Video implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * Array of strings (VideoMimeType)
     * @required
     * @var array
     */
    protected $mimes;

    /**
     * Minimum video ad duration in seconds
     * @required
     * @var int
     */
    protected $minduration;

    /**
     * Maximum video ad duration in seconds
     * @required
     * @var int
     */
    protected $maxduration;

    /**
     * Array of integers (VideoBidResponseProtocols from BidRequest)
     * @required
     * @var array
     */
    protected $protocols;

    /**
     * @var
     */
    protected $ext;

    /**
     * @return mixed
     */
    public function getMimes()
    {
        return $this->mimes;
    }

    /**
     * @param string $mimes
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addMimes($mimes)
    {
        $this->validateIn($mimes, VideoMimeType::getAll());
        $this->mimes = $mimes;
        return $this;
    }

    /**
     * @param array $mimes
     * @return $this
     */
    public function setMimes(array $mimes)
    {
        $this->mimes = $mimes;
        return $this;
    }

    /**
     * @return int
     */
    public function getMinduration()
    {
        return $this->minduration;
    }

    /**
     * @param int $minduration
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setMinduration($minduration)
    {
        $this->minduration = $this->validateInt($minduration);
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxduration()
    {
        return $this->maxduration;
    }

    /**
     * @param int $maxduration
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setMaxduration($maxduration)
    {
        $this->maxduration = $this->validateInt($maxduration);
        return $this;
    }

    /**
     * @return array
     */
    public function getProtocols()
    {
        return $this->protocols;
    }

    /**
     * @param int $protocols
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addProtocols($protocols)
    {
        $this->validateIn($protocols, VideoBidResponseProtocols::getAll());
        $this->protocols[] = $protocols;
        return $this;
    }

    /**
     * @param array $protocols
     * @return $this
     */
    public function setProtocols(array $protocols)
    {
        $this->protocols = $protocols;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExt()
    {
        return $this->ext;
    }

    /**
     * @param $ext
     * @return $this
     */
    public function setExt($ext)
    {
        $this->ext = $ext;
        return $this;
    }
}
