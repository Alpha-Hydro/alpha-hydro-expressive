<?php

namespace Api\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * OilCategories
 *
 * @ORM\Table(name="oil_categories", uniqueConstraints={@ORM\UniqueConstraint(name="oil_categories_id_uindex", columns={"id"}), @ORM\UniqueConstraint(name="oil_categories_full_path_uindex", columns={"full_path"})})
 * @ORM\Entity(repositoryClass="Api\Repository\OilCategoryRepository")
 */
class OilCategories
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent_id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $parentId;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="full_path", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $fullPath;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="content_html", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $contentHtml;

    /**
     * @var string
     *
     * @ORM\Column(name="content_markdown", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $contentMarkdown;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $image;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $createDate;

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
     * @ORM\Column(name="meta_keywords", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $metaKeywords;

    /**
     * @var integer
     *
     * @ORM\Column(name="active", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $active;

    /**
     * @var integer
     *
     * @ORM\Column(name="sorting", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $sorting;

    /**
     * @var integer
     *
     * @ORM\Column(name="deleted", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $deleted;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Api\Entity\Oil", mappedBy="category")
     */
    private $oils;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->oils = new ArrayCollection();
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
     * @return OilCategories
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
     * Set title
     *
     * @param string $title
     *
     * @return OilCategories
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return OilCategories
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
     * Set fullPath
     *
     * @param string $fullPath
     *
     * @return OilCategories
     */
    public function setFullPath($fullPath)
    {
        $this->fullPath = $fullPath;

        return $this;
    }

    /**
     * Get fullPath
     *
     * @return string
     */
    public function getFullPath()
    {
        return $this->fullPath;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return OilCategories
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
     * Set contentHtml
     *
     * @param string $contentHtml
     *
     * @return OilCategories
     */
    public function setContentHtml($contentHtml)
    {
        $this->contentHtml = $contentHtml;

        return $this;
    }

    /**
     * Get contentHtml
     *
     * @return string
     */
    public function getContentHtml()
    {
        return $this->contentHtml;
    }

    /**
     * Set contentMarkdown
     *
     * @param string $contentMarkdown
     *
     * @return OilCategories
     */
    public function setContentMarkdown($contentMarkdown)
    {
        $this->contentMarkdown = $contentMarkdown;

        return $this;
    }

    /**
     * Get contentMarkdown
     *
     * @return string
     */
    public function getContentMarkdown()
    {
        return $this->contentMarkdown;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return OilCategories
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
     * Set createDate
     *
     * @param \DateTime $createDate
     *
     * @return OilCategories
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set metaTitle
     *
     * @param string $metaTitle
     *
     * @return OilCategories
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
     * @return OilCategories
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
     * @return OilCategories
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
     * Set active
     *
     * @param integer $active
     *
     * @return OilCategories
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
     * Set sorting
     *
     * @param integer $sorting
     *
     * @return OilCategories
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
     * Set deleted
     *
     * @param integer $deleted
     *
     * @return OilCategories
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
     * Add oil
     *
     * @param Oil $oil
     *
     * @return OilCategories
     */
    public function addOil(Oil $oil)
    {
        $this->oils[] = $oil;

        return $this;
    }

    /**
     * Remove oil
     *
     * @param Oil $oil
     */
    public function removeOil(Oil $oil)
    {
        $this->oils->removeElement($oil);
    }

    /**
     * Get oils
     *
     * @return Collection
     */
    public function getOils()
    {
        return $this->oils;
    }
}

