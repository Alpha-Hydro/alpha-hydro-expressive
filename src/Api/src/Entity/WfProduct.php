<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WfProduct
 *
 * @ORM\Table(name="wf_product", indexes={@ORM\Index(name="fk_product_category1_idx", columns={"category_id"}), @ORM\Index(name="fk_product_product_construction1_idx", columns={"product_construction_id"}), @ORM\Index(name="fk_product_product_size1_idx", columns={"product_size_id"}), @ORM\Index(name="fk_product_product_type1_idx", columns={"product_type_id"}), @ORM\Index(name="fk_product_product_control1_idx", columns={"product_control_id"})})
 * @ORM\Entity
 */
class WfProduct
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="data_sheet_no", type="string", length=11, precision=0, scale=0, nullable=false, unique=false)
     */
    private $dataSheetNo;

    /**
     * @var string
     *
     * @ORM\Column(name="data_sheet_pdf", type="string", length=45, precision=0, scale=0, nullable=false, unique=false)
     */
    private $dataSheetPdf;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=128, precision=0, scale=0, nullable=true, unique=false)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="content_markdown", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $contentMarkdown;

    /**
     * @var string
     *
     * @ORM\Column(name="content_html", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $contentHtml;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=128, precision=0, scale=0, nullable=true, unique=false)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="full_path", type="string", length=128, precision=0, scale=0, nullable=true, unique=false)
     */
    private $fullPath;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $active;

    /**
     * @var boolean
     *
     * @ORM\Column(name="deleted", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $deleted;

    /**
     * @var integer
     *
     * @ORM\Column(name="sorting", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $sorting;

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
     * @var string
     *
     * @ORM\Column(name="meta_title", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $metaTitle;

    /**
     * @var \Api\Entity\WfCategory
     *
     * @ORM\ManyToOne(targetEntity="Api\Entity\WfCategory", inversedBy="products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $category;

    /**
     * @var \Api\Entity\WfProductConstruction
     *
     * @ORM\ManyToOne(targetEntity="Api\Entity\WfProductConstruction", inversedBy="products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_construction_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $productConstruction;

    /**
     * @var \Api\Entity\WfProductControl
     *
     * @ORM\ManyToOne(targetEntity="Api\Entity\WfProductControl", inversedBy="products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_control_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $productControl;

    /**
     * @var \Api\Entity\WfProductSize
     *
     * @ORM\ManyToOne(targetEntity="Api\Entity\WfProductSize", inversedBy="products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_size_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $productSize;

    /**
     * @var \Api\Entity\WfProductType
     *
     * @ORM\ManyToOne(targetEntity="Api\Entity\WfProductType", inversedBy="products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_type_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $productType;


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
     * Set name
     *
     * @param string $name
     *
     * @return WfProduct
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
     * Set dataSheetNo
     *
     * @param string $dataSheetNo
     *
     * @return WfProduct
     */
    public function setDataSheetNo($dataSheetNo)
    {
        $this->dataSheetNo = $dataSheetNo;

        return $this;
    }

    /**
     * Get dataSheetNo
     *
     * @return string
     */
    public function getDataSheetNo()
    {
        return $this->dataSheetNo;
    }

    /**
     * Set dataSheetPdf
     *
     * @param string $dataSheetPdf
     *
     * @return WfProduct
     */
    public function setDataSheetPdf($dataSheetPdf)
    {
        $this->dataSheetPdf = $dataSheetPdf;

        return $this;
    }

    /**
     * Get dataSheetPdf
     *
     * @return string
     */
    public function getDataSheetPdf()
    {
        return $this->dataSheetPdf;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return WfProduct
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
     * Set description
     *
     * @param string $description
     *
     * @return WfProduct
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
     * Set contentMarkdown
     *
     * @param string $contentMarkdown
     *
     * @return WfProduct
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
     * @return WfProduct
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
     * Set path
     *
     * @param string $path
     *
     * @return WfProduct
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
     * @return WfProduct
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
     * Set active
     *
     * @param boolean $active
     *
     * @return WfProduct
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
     * Set deleted
     *
     * @param boolean $deleted
     *
     * @return WfProduct
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set sorting
     *
     * @param integer $sorting
     *
     * @return WfProduct
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
     * Set metaDescription
     *
     * @param string $metaDescription
     *
     * @return WfProduct
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
     * @return WfProduct
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
     * @return WfProduct
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
     * Set category
     *
     * @param \Api\Entity\WfCategory $category
     *
     * @return WfProduct
     */
    public function setCategory(\Api\Entity\WfCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Api\Entity\WfCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set productConstruction
     *
     * @param \Api\Entity\WfProductConstruction $productConstruction
     *
     * @return WfProduct
     */
    public function setProductConstruction(\Api\Entity\WfProductConstruction $productConstruction = null)
    {
        $this->productConstruction = $productConstruction;

        return $this;
    }

    /**
     * Get productConstruction
     *
     * @return \Api\Entity\WfProductConstruction
     */
    public function getProductConstruction()
    {
        return $this->productConstruction;
    }

    /**
     * Set productControl
     *
     * @param \Api\Entity\WfProductControl $productControl
     *
     * @return WfProduct
     */
    public function setProductControl(\Api\Entity\WfProductControl $productControl = null)
    {
        $this->productControl = $productControl;

        return $this;
    }

    /**
     * Get productControl
     *
     * @return \Api\Entity\WfProductControl
     */
    public function getProductControl()
    {
        return $this->productControl;
    }

    /**
     * Set productSize
     *
     * @param \Api\Entity\WfProductSize $productSize
     *
     * @return WfProduct
     */
    public function setProductSize(\Api\Entity\WfProductSize $productSize = null)
    {
        $this->productSize = $productSize;

        return $this;
    }

    /**
     * Get productSize
     *
     * @return \Api\Entity\WfProductSize
     */
    public function getProductSize()
    {
        return $this->productSize;
    }

    /**
     * Set productType
     *
     * @param \Api\Entity\WfProductType $productType
     *
     * @return WfProduct
     */
    public function setProductType(\Api\Entity\WfProductType $productType = null)
    {
        $this->productType = $productType;

        return $this;
    }

    /**
     * Get productType
     *
     * @return \Api\Entity\WfProductType
     */
    public function getProductType()
    {
        return $this->productType;
    }
}

