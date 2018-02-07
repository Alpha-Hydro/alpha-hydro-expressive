<?php

namespace Api\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;

/**
 * Categories
 *
 * @ORM\Table(name="categories", indexes={@ORM\Index(name="parent_id", columns={"parent_id"})})
 * @ORM\Entity(repositoryClass="Api\Repository\CategoryRepository")
 */
class Categories
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent_id", type="bigint", nullable=false)
     */
    private $parentId;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="add_date", type="datetime", nullable=true)
     */
    private $addDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="mod_date", type="datetime", nullable=true)
     */
    private $modDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="generate", type="integer", nullable=true)
     */
    private $generate;

    /**
     * @var integer
     *
     * @ORM\Column(name="active", type="integer", nullable=false)
     */
    private $active;

    /**
     * @var string
     *
     * @ORM\Column(name="full_path", type="string", length=255, nullable=true)
     */
    private $fullPath;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_description", type="text", length=65535, nullable=true)
     */
    private $metaDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_keywords", type="string", length=255, nullable=true)
     */
    private $metaKeywords;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_title", type="string", length=255, nullable=true)
     */
    private $metaTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=128, nullable=true)
     */
    private $path;

    /**
     * @var integer
     *
     * @ORM\Column(name="sorting", type="integer", nullable=false)
     */
    private $sorting;

    /**
     * @var integer
     *
     * @ORM\Column(name="deleted", type="integer", nullable=false)
     */
    private $deleted;

    /**
     * @var string
     *
     * @ORM\Column(name="upload_path", type="string", length=128, nullable=true)
     */
    private $uploadPath;

    /**
     * @var string
     *
     * @ORM\Column(name="content_markdown", type="text", length=65535, nullable=true)
     */
    private $contentMarkdown;

    /**
     * @var string
     *
     * @ORM\Column(name="content_html", type="text", length=65535, nullable=true)
     */
    private $contentHtml;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Api\Entity\Products", mappedBy="category")
     */
    private $products;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Api\Entity\Categories", mappedBy="parent")
     */
    private $children;

    /**
     * @var Categories
     *
     * @ORM\ManyToOne(targetEntity="Api\Entity\Categories", inversedBy="children")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $parent;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->children = new ArrayCollection();
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
     * @return Categories
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
     * Set image
     *
     * @param string $image
     *
     * @return Categories
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
     * Set name
     *
     * @param string $name
     *
     * @return Categories
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
     * @return Categories
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
     * Set addDate
     *
     * @param \DateTime $addDate
     *
     * @return Categories
     */
    public function setAddDate($addDate)
    {
        $this->addDate = $addDate;

        return $this;
    }

    /**
     * Get addDate
     *
     * @return \DateTime
     */
    public function getAddDate()
    {
        return $this->addDate;
    }

    /**
     * Set modDate
     *
     * @param \DateTime $modDate
     *
     * @return Categories
     */
    public function setModDate($modDate)
    {
        $this->modDate = $modDate;

        return $this;
    }

    /**
     * Get modDate
     *
     * @return \DateTime
     */
    public function getModDate()
    {
        return $this->modDate;
    }

    /**
     * Set generate
     *
     * @param integer $generate
     *
     * @return Categories
     */
    public function setGenerate($generate)
    {
        $this->generate = $generate;

        return $this;
    }

    /**
     * Get generate
     *
     * @return boolean
     */
    public function getGenerate()
    {
        return $this->generate;
    }

    /**
     * Set active
     *
     * @param integer $active
     *
     * @return Categories
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
     * Set fullPath
     *
     * @param string $fullPath
     *
     * @return Categories
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
     * Set metaDescription
     *
     * @param string $metaDescription
     *
     * @return Categories
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
     * @return Categories
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
     * Set metaTitle
     *
     * @param string $metaTitle
     *
     * @return Categories
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
     * Set path
     *
     * @param string $path
     *
     * @return Categories
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
     * Set sorting
     *
     * @param integer $sorting
     *
     * @return Categories
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
     * @return Categories
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
     * Set uploadPath
     *
     * @param string $uploadPath
     *
     * @return Categories
     */
    public function setUploadPath($uploadPath)
    {
        $this->uploadPath = $uploadPath;

        return $this;
    }

    /**
     * Get uploadPath
     *
     * @return string
     */
    public function getUploadPath()
    {
        return $this->uploadPath;
    }

    /**
     * Set contentMarkdown
     *
     * @param string $contentMarkdown
     *
     * @return Categories
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
     * Set contentHtml
     *
     * @param string $contentHtml
     *
     * @return Categories
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
     * Add product
     *
     * @param Products $product
     *
     * @return Categories
     */
    public function addProduct(Products $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param Products $product
     */
    public function removeProduct(Products $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @param bool $all
     * @return Collection
     */
    public function getProducts($all = false)
    {
        $criteria = Criteria::create();
        if (!$all){
            $criteria
                ->where(Criteria::expr()->eq('active', 1))
                ->where(Criteria::expr()->eq('deleted', 0))
            ;
        }
        $criteria->orderBy(['sorting' => Criteria::ASC]);

        return $this->products->matching($criteria);
    }

    /**
     * Add child
     *
     * @param Categories $child
     *
     * @return Categories
     */
    public function addChild(Categories $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param Categories $child
     */
    public function removeChild(Categories $child)
    {
        $this->children->removeElement($child);
    }

    /**
     * Get children
     *
     * @param bool $all
     * @return Collection
     */
    public function getChildren($all = false)
    {
        $criteria = Criteria::create();
        if (!$all){
            $criteria
                ->where(Criteria::expr()->eq('active', 1))
                ->where(Criteria::expr()->eq('deleted', 0))
            ;
        }
        $criteria->orderBy(['sorting' => Criteria::ASC]);

        return $this->children->matching($criteria);
    }

    /**
     * Set parent
     *
     * @param Categories $parent
     *
     * @return Categories
     */
    public function setParent(Categories $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return Categories
     */
    public function getParent()
    {
        $parentId = $this->parentId;
        if ($parentId != 0)
            return $this->parent;

        return null;
    }
}
