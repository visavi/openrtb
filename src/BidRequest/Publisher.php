<?php

namespace OpenRtb\BidRequest;

use OpenRtb\Tools\Interfaces\Arrayable;
use OpenRtb\Tools\Traits\SetterValidation;
use OpenRtb\Tools\Traits\ToArray;

class Publisher implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * Exchange-specific publisher ID as defined by the publisher code suffix of the web property code.
     * For example, pub-123 is the publisher code of the web property code ca-pub-123.
     *
     * @var string
     */
    protected $id;

    /**
     * Publisher name (may be aliased at publisher's request)
     *
     * @var string
     */
    protected $name;

    /**
     * Array of IAB content categories of the app. Refer to enum ContentCategory.
     *
     * Array of strings
     * @var array
     */
    protected $cat;

    /**
     * Highest level domain of the publisher (e.g., “publisher.com”)
     *
     * @var string
     */
    protected $domain;

    /**
     * @var Ext
     */
    protected $ext;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setId($id)
    {
        $this->validateString($id);
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setName($name)
    {
        $this->validateString($name);
        $this->name = $name;
        return $this;
    }

    /**
     * @return array
     */
    public function getCat()
    {
        return $this->cat;
    }

    /**
     * @param $cat
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addCat($cat)
    {
        $this->validateString($cat);
        $this->cat[] = $cat;
        return $this;
    }

    /**
     * @param array $cat
     * @return $this
     */
    public function setCat(array $cat)
    {
        $this->cat = $cat;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param $domain
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setDomain($domain)
    {
        $this->validateString($domain);
        $this->domain = $domain;
        return $this;
    }

    /**
     * @return Ext
     */
    public function getExt()
    {
        return $this->ext;
    }

    /**
     * @param Ext $ext
     * @return $this
     */
    public function setExt(Ext $ext)
    {
        $this->ext = $ext;
        return $this;
    }
}
