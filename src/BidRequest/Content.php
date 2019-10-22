<?php

namespace OpenRtb\BidRequest;

use OpenRtb\BidRequest\Specification\ProductionQuality;
use OpenRtb\Tools\Interfaces\Arrayable;
use OpenRtb\BidRequest\Specification\BitType;
use OpenRtb\BidRequest\Specification\ContentContext;
use OpenRtb\BidRequest\Specification\QagMediaRatings;
use OpenRtb\Tools\Traits\SetterValidation;
use OpenRtb\Tools\Traits\ToArray;

class Content implements Arrayable
{
    use SetterValidation;
    use ToArray;
    /**
     * ID uniquely identifying the content.
     *
     * @var string
     */
    protected $id;

    /**
     * Content episode number (typically applies to video content).
     *
     * Episode number
     * @var int
     */
    protected $episode;

    /**
     * Content title. Video examples: "Search Committee" (television), "A New Hope" (movie),or "Endgame" (made for web).
     * Non-Video example: "Why an Antarctic Glacier Is Melting So Quickly" (Time magazine article).
     *
     * @var string
     */
    protected $title;

    /**
     * Content series. Video examples: "The Office" (television), "Star Wars" (movie) or "Arby 'N' The Chief" (made for web).
     * Non-Video example: "Ecocentric" (Time Magazine blog)
     *
     * @var string
     */
    protected $series;

    /**
     * Content season; typically for video content (e.g., “Season 3”)
     *
     * @var string
     */
    protected $season;

    /**
     * Artist credited with the content
     *
     * @var string
     */
    protected $artist;

    /**
     * Genre that best describes the content (e.g., rock, pop, etc.).
     *
     * @var string
     */
    protected $genre;

    /**
     * Album to which the content belongs; typically for audio.
     *
     * @var string
     */
    protected $album;

    /**
     * International Standard Recording Code conforming to ISO-3901
     *
     * @var string
     */
    protected $isrc;

    /**
     * URL of the content, for buy-side contextualization or review.
     * @var string
     */
    protected $url;

    /**
     * Array of IAB content categories that describe the content. Refer to enum ContentCategory
     *
     * Array of Strings
     * @var array
     */
    protected $cat;

    /**
     * @var ProductionQuality
     */
    protected $prodq;

    /**
     * Comma separated list of keywords describing the content.
     *
     * @var string
     */
    protected $keywords;

    /**
     * Content rating (e.g., MPAA).
     *
     * Content rating (e.g., MPAA)
     * @var string
     */
    protected $contentrating;

    /**
     * User rating of the content (e.g., number of stars, likes, etc.)
     *
     * @var string
     */
    protected $userrating;

    /**
     * Type of content (game, video, text, etc.).
     *
     * OpenRtb\BidRequest\Specification\ContentContext
     * @var int
     */
    protected $context;

    /**
     * OpenRTB <= 2.2 compatibility; use context for 2.3+
     *
     * @var string
     */
    protected $context_22;

    /**
     * 0 = not live, 1 = content is live (e.g., stream, live blog).
     *
     * @var int
     */
    protected $livestream;

    /**
     * 0 = indirect, 1 = direct
     *
     * @var int
     */
    protected $sourcerelationship;

    /**
     * Details about the content Producer.
     *
     * @var Producer
     */
    protected $producer;

    /**
     * Length of content in seconds; appropriate for video or audio
     *
     * @var int
     */
    protected $len;

    /**
     * Media rating per QAG guidelines
     * OpenRtb\BidRequest\Specification\QagMediaRatings
     * @var int
     */
    protected $qagmediarating;

    /**
     * Indicator of whether or not the content is embeddable (e.g., an embeddable video player), where 0 = no, 1 = yes
     * @var int
     */
    protected $embeddable;

    /**
     * Content language using ISO-639-1-alpha-2
     * @var string
     */
    protected $language;

    /**
     * @var Ext
     */
    protected $ext;

    public function __construct()
    {
        $this->initialize();
    }

    public function initialize()
    {
        $this->setProducer(new Producer());
    }

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
     * @return int
     */
    public function getEpisode()
    {
        return $this->episode;
    }

    /**
     * @param $episode
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setEpisode($episode)
    {
        $this->episode = $this->validatePositiveInt($episode);
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $title
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setTitle($title)
    {
        $this->validateString($title);
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * @param $series
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setSeries($series)
    {
        $this->validateString($series);
        $this->series = $series;
        return $this;
    }

    /**
     * @return string
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * @param $season
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setSeason($season)
    {
        $this->validateString($season);
        $this->season = $season;
        return $this;
    }

    /**
     * @return Producer
     */
    public function getProducer()
    {
        return $this->producer;
    }

    /**
     * @param Producer $producer
     * @return $this
     */
    public function setProducer(Producer $producer)
    {
        $this->producer = $producer;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param $url
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setUrl($url)
    {
        $this->validateString($url);
        $this->url = $url;
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
     * @return int
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param $context
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setContext($context)
    {
        $this->validateIn($context, ContentContext::getAll());
        $this->context = $context;
        return $this;
    }

    /**
     * @return string
     */
    public function getContentrating()
    {
        return $this->contentrating;
    }

    /**
     * @param $contentrating
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setContentrating($contentrating)
    {
        $this->validateString($contentrating);
        $this->contentrating = $contentrating;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserrating()
    {
        return $this->userrating;
    }

    /**
     * @param $userrating
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setUserrating($userrating)
    {
        $this->validateString($userrating);
        $this->userrating = $userrating;
        return $this;
    }

    /**
     * @return int
     */
    public function getQagmediarating()
    {
        return $this->qagmediarating;
    }

    /**
     * @param $qagmediarating
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setQagmediarating($qagmediarating)
    {
        $this->validateIn($qagmediarating, QagMediaRatings::getAll());
        $this->qagmediarating = $qagmediarating;
        return $this;
    }

    /**
     * @return string
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param $keywords
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setKeywords($keywords)
    {
        $this->validateString($keywords);
        $this->keywords = $keywords;
        return $this;
    }

    /**
     * @return int
     */
    public function getLivestream()
    {
        return $this->livestream;
    }

    /**
     * @param $livestream
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setLivestream($livestream)
    {
        $this->validateIn($livestream, BitType::getAll());
        $this->livestream = $livestream;
        return $this;
    }

    /**
     * @return int
     */
    public function getSourcerelationship()
    {
        return $this->sourcerelationship;
    }

    /**
     * @param $sourcerelationship
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setSourcerelationship($sourcerelationship)
    {
        $this->validateIn($sourcerelationship, BitType::getAll());
        $this->sourcerelationship = $sourcerelationship;
        return $this;
    }

    /**
     * @return int
     */
    public function getLen()
    {
        return $this->len;
    }

    /**
     * @param $len
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setLen($len)
    {
        $this->len = $this->validatePositiveInt($len);
        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param $language
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setLanguage($language)
    {
        $this->validateString($language);
        $this->language = $language;
        return $this;
    }

    /**
     * @return int
     */
    public function getEmbeddable()
    {
        return $this->embeddable;
    }

    /**
     * @param $embeddable
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setEmbeddable($embeddable)
    {
        $this->validateIn($embeddable, BitType::getAll());
        $this->embeddable = $embeddable;
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

    /**
     * @return string
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * @param $artist
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setArtist($artist)
    {
        $this->validateString($artist);
        $this->artist = $artist;

        return $this;
    }

    /**
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param $genre
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setGenre($genre)
    {
        $this->validateString($genre);
        $this->genre = $genre;

        return $this;
    }

    /**
     * @return string
     */
    public function getAlbum()
    {
        return $this->album;
    }

    /**
     * @param $album
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setAlbum($album)
    {
        $this->validateString($album);
        $this->album = $album;

        return $this;
    }

    /**
     * @return string
     */
    public function getIsrc()
    {
        return $this->isrc;
    }

    /**
     * @param $isrc
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setIsrc($isrc)
    {
        $this->validateString($isrc);
        $this->isrc = $isrc;

        return $this;
    }

    /**
     * @return ProductionQuality
     */
    public function getProdq()
    {
        return $this->prodq;
    }

    /**
     * @param $prodq
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setProdq($prodq)
    {
        $this->validateIn($prodq, ProductionQuality::getAll());
        $this->prodq = $prodq;

        return $this;
    }

    /**
     * @return string
     */
    public function getContext22()
    {
        return $this->context_22;
    }

    /**
     * @param $context_22
     * @return $this
     * @throws \OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setContext22($context_22)
    {
        $this->validateString($context_22);
        $this->context_22 = $context_22;

        return $this;
    }


}
