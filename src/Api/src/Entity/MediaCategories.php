<?php

namespace Api\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MediaCategories
 *
 * @ORM\Table(name="media_categories", uniqueConstraints={@ORM\UniqueConstraint(name="unique_id", columns={"id"})})
 * @ORM\Entity(repositoryClass="Api\Repository\MediaCategoryRepository")
 */
class MediaCategories
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent_id", type="bigint", precision=0, scale=0, nullable=true, unique=false)
     */
    private $parentId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", precision=0, scale=0, nullable=false, unique=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $image;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timestamp", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $timestamp;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_title", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $metaTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_description", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $metaDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_keywords", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $metaKeywords;

    /**
     * @var integer
     *
     * @ORM\Column(name="sorting", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $sorting;

    /**
     * @var integer
     *
     * @ORM\Column(name="active", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $active;

    /**
     * @var integer
     *
     * @ORM\Column(name="deleted", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $deleted;

    /**
     * @var string
     *
     * @ORM\Column(name="thumb", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $thumb;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Api\Entity\Media", mappedBy="mediaCategory")
     */
    private $mediaPosts;

    /**
     * MediaCategories constructor.
     */
    public function __construct()
    {
        $this->mediaPosts = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set parentId
     *
     * @param integer $parentId
     *
     * @return MediaCategories
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * Get parentId
     *
     * @return integer
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return MediaCategories
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return MediaCategories
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return MediaCategories
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     *
     * @return MediaCategories
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return MediaCategories
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set metaTitle
     *
     * @param string $metaTitle
     *
     * @return MediaCategories
     */
    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    /**
     * Get metaTitle
     *
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * Set metaDescription
     *
     * @param string $metaDescription
     *
     * @return MediaCategories
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * Get metaDescription
     *
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * Set metaKeywords
     *
     * @param string $metaKeywords
     *
     * @return MediaCategories
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    /**
     * Get metaKeywords
     *
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * Set sorting
     *
     * @param integer $sorting
     *
     * @return MediaCategories
     */
    public function setSorting($sorting)
    {
        $this->sorting = $sorting;

        return $this;
    }

    /**
     * Get sorting
     *
     * @return integer
     */
    public function getSorting()
    {
        return $this->sorting;
    }

    /**
     * Set active
     *
     * @param integer $active
     *
     * @return MediaCategories
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return integer
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set deleted
     *
     * @param integer $deleted
     *
     * @return MediaCategories
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return integer
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set thumb
     *
     * @param string $thumb
     *
     * @return MediaCategories
     */
    public function setThumb($thumb)
    {
        $this->thumb = $thumb;

        return $this;
    }

    /**
     * Get thumb
     *
     * @return string
     */
    public function getThumb()
    {
        return $this->thumb;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMediaPosts()
    {
        return $this->mediaPosts;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $mediaPosts
     */
    public function setMediaPosts($mediaPosts)
    {
        $this->mediaPosts = $mediaPosts;
    }
}

