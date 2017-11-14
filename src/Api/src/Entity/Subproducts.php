<?php

namespace Api\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;

/**
 * Subproducts
 *
 * @ORM\Table(name="subproducts", indexes={@ORM\Index(name="order", columns={"order"}), @ORM\Index(name="product_id", columns={"parent_id"}), @ORM\Index(name="sku", columns={"sku"})})
 * @ORM\Entity
 */
class Subproducts
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
     * @var integer
     *
     * @ORM\Column(name="deleted", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $deleted;

    /**
     * @var Products
     *
     * @ORM\ManyToOne(targetEntity="Api\Entity\Products", inversedBy="modifications")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $product;


    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Api\Entity\SubproductParamsValues", mappedBy="subproducts")
     * @ORM\OrderBy({"paramId" = "ASC"})
     */
    private $paramValues;

    /**
     * Subproducts constructor.
     */
    public function __construct()
    {
        $this->paramValues = new ArrayCollection();
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
     * @return Subproducts
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
     * Set sku
     *
     * @param string $sku
     *
     * @return Subproducts
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
     * @return Subproducts
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
     * Set addDate
     *
     * @param \DateTime $addDate
     *
     * @return Subproducts
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
     * @return Subproducts
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
     * @return Subproducts
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
     * Set deleted
     *
     * @param integer $deleted
     *
     * @return Subproducts
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
     * Set product
     *
     * @param Products $product
     *
     * @return Subproducts
     */
    public function setProduct(Products $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return Products
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Add paramValue
     *
     * @param SubproductParamsValues $paramValue
     *
     * @return Subproducts
     */
    public function addParamValue(SubproductParamsValues $paramValue)
    {
        $this->paramValues[] = $paramValue;

        return $this;
    }

    /**
     * Remove paramValue
     *
     * @param SubproductParamsValues $paramValue
     */
    public function removeParamValue(SubproductParamsValues $paramValue)
    {
        $this->paramValues->removeElement($paramValue);
    }

    /**
     * Get paramValues
     *
     * @return Collection
     */
    public function getParamValues()
    {
        return $this->paramValues;
    }
}

