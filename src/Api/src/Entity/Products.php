<?php

namespace Api\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Products
 *
 * @ORM\Table(name="products", indexes={@ORM\Index(name="order", columns={"order"}), @ORM\Index(name="product_id", columns={"parent_id"}), @ORM\Index(name="s_name", columns={"s_name"}), @ORM\Index(name="sku", columns={"sku"}), @ORM\Index(name="category_id", columns={"category_id"})})
 * @ORM\Entity
 */
class Products
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
     * @ORM\Column(name="category_id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $categoryId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="parent_id", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    private $parentId;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="a_images", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $aImages;

    /**
     * @var string
     *
     * @ORM\Column(name="draft", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $draft;

    /**
     * @var string
     *
     * @ORM\Column(name="sku", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $sku;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="s_name", type="string", length=2028, precision=0, scale=0, nullable=true, unique=false)
     */
    private $sName;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="add_date", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $addDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="mod_date", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $modDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="order", type="bigint", precision=0, scale=0, nullable=true, unique=false)
     */
    private $order;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $active;

    /**
     * @var string
     *
     * @ORM\Column(name="full_path", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $fullPath;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_description", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $metaDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_keywords", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $metaKeywords;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_title", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $metaTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=128, precision=0, scale=0, nullable=true, unique=false)
     */
    private $path;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sorting", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $sorting;

    /**
     * @var integer
     *
     * @ORM\Column(name="deleted", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $deleted;

    /**
     * @var string
     *
     * @ORM\Column(name="upload_path", type="string", length=128, precision=0, scale=0, nullable=true, unique=false)
     */
    private $uploadPath;

    /**
     * @var string
     *
     * @ORM\Column(name="upload_path_draft", type="string", length=128, precision=0, scale=0, nullable=true, unique=false)
     */
    private $uploadPathDraft;

    /**
     * @var Categories
     *
     * @ORM\ManyToOne(targetEntity="Api\Entity\Categories", inversedBy="products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $category;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Api\Entity\ProductParams", mappedBy="product")
     */
    private $params;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->params = new ArrayCollection();
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
     * Set categoryId
     *
     * @param integer $categoryId
     *
     * @return Products
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set parentId
     *
     * @param boolean $parentId
     *
     * @return Products
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * Get parentId
     *
     * @return boolean
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
     * @return Products
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
     * Set aImages
     *
     * @param string $aImages
     *
     * @return Products
     */
    public function setAImages($aImages)
    {
        $this->aImages = $aImages;

        return $this;
    }

    /**
     * Get aImages
     *
     * @return string
     */
    public function getAImages()
    {
        return $this->aImages;
    }

    /**
     * Set draft
     *
     * @param string $draft
     *
     * @return Products
     */
    public function setDraft($draft)
    {
        $this->draft = $draft;

        return $this;
    }

    /**
     * Get draft
     *
     * @return string
     */
    public function getDraft()
    {
        return $this->draft;
    }

    /**
     * Set sku
     *
     * @param string $sku
     *
     * @return Products
     */
    public function setSku($sku)
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * Get sku
     *
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Products
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
     * Set sName
     *
     * @param string $sName
     *
     * @return Products
     */
    public function setSName($sName)
    {
        $this->sName = $sName;

        return $this;
    }

    /**
     * Get sName
     *
     * @return string
     */
    public function getSName()
    {
        return $this->sName;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return Products
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Products
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
     * @return Products
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
     * @return Products
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
     * Set order
     *
     * @param integer $order
     *
     * @return Products
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return integer
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Products
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
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
     * @return Products
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
     * @return Products
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
     * @return Products
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
     * @return Products
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
     * @return Products
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
     * @param boolean $sorting
     *
     * @return Products
     */
    public function setSorting($sorting)
    {
        $this->sorting = $sorting;

        return $this;
    }

    /**
     * Get sorting
     *
     * @return boolean
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
     * @return Products
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
     * @return Products
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
     * Set uploadPathDraft
     *
     * @param string $uploadPathDraft
     *
     * @return Products
     */
    public function setUploadPathDraft($uploadPathDraft)
    {
        $this->uploadPathDraft = $uploadPathDraft;

        return $this;
    }

    /**
     * Get uploadPathDraft
     *
     * @return string
     */
    public function getUploadPathDraft()
    {
        return $this->uploadPathDraft;
    }

    /**
     * Set category
     *
     * @param Categories $category
     *
     * @return Products
     */
    public function setCategory(Categories $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return Categories
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add param
     *
     * @param ProductParams $param
     *
     * @return Products
     */
    public function addParam(ProductParams $param)
    {
        $this->params[] = $param;

        return $this;
    }

    /**
     * Remove param
     *
     * @param ProductParams $param
     */
    public function removeParam(ProductParams $param)
    {
        $this->params->removeElement($param);
    }

    /**
     * Get params
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParams()
    {
        return $this->params;
    }
}

