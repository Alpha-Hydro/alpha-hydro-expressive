<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pipeline
 *
 * @ORM\Table(name="pipeline", uniqueConstraints={@ORM\UniqueConstraint(name="unique_id", columns={"id"}), @ORM\UniqueConstraint(name="unique_full_path", columns={"full_path"})})
 * @ORM\Entity
 */
class Pipeline
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
     * @ORM\Column(name="category_id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $categoryId;

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
     * @ORM\Column(name="title", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $title;

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
     * @var string
     *
     * @ORM\Column(name="image_draft", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $imageDraft;

    /**
     * @var string
     *
     * @ORM\Column(name="image_table", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $imageTable;

    /**
     * @var string
     *
     * @ORM\Column(name="gost_name", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $gostName;

    /**
     * @var PipelineCategories
     *
     * @ORM\ManyToOne(targetEntity="Api\Entity\PipelineCategories", inversedBy="pipelines")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $pipelineCategory;


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
     * @return Pipeline
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
     * Set path
     *
     * @param string $path
     *
     * @return Pipeline
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
     * @return Pipeline
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
     * Set title
     *
     * @param string $title
     *
     * @return Pipeline
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
     * Set description
     *
     * @param string $description
     *
     * @return Pipeline
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
     * @return Pipeline
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
     * @return Pipeline
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
     * @return Pipeline
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
     * @return Pipeline
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
     * @return Pipeline
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
     * @return Pipeline
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
     * @return Pipeline
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
     * @return Pipeline
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
     * @return Pipeline
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
     * @return Pipeline
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
     * Set imageDraft
     *
     * @param string $imageDraft
     *
     * @return Pipeline
     */
    public function setImageDraft($imageDraft)
    {
        $this->imageDraft = $imageDraft;

        return $this;
    }

    /**
     * Get imageDraft
     *
     * @return string
     */
    public function getImageDraft()
    {
        return $this->imageDraft;
    }

    /**
     * Set imageTable
     *
     * @param string $imageTable
     *
     * @return Pipeline
     */
    public function setImageTable($imageTable)
    {
        $this->imageTable = $imageTable;

        return $this;
    }

    /**
     * Get imageTable
     *
     * @return string
     */
    public function getImageTable()
    {
        return $this->imageTable;
    }

    /**
     * Set gostName
     *
     * @param string $gostName
     *
     * @return Pipeline
     */
    public function setGostName($gostName)
    {
        $this->gostName = $gostName;

        return $this;
    }

    /**
     * Get gostName
     *
     * @return string
     */
    public function getGostName()
    {
        return $this->gostName;
    }

    /**
     * Set pipelineCategory
     *
     * @param PipelineCategories $pipelineCategory
     *
     * @return Pipeline
     */
    public function setPipelineCategory(PipelineCategories $pipelineCategory = null)
    {
        $this->pipelineCategory = $pipelineCategory;

        return $this;
    }

    /**
     * Get pipelineCategory
     *
     * @return PipelineCategories
     */
    public function getPipelineCategory()
    {
        return $this->pipelineCategory;
    }
}

