<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SubproductParams
 *
 * @ORM\Table(name="subproduct_params", indexes={@ORM\Index(name="subproduct_id", columns={"product_id"}), @ORM\Index(name="order", columns={"order"})})
 * @ORM\Entity
 */
class SubproductParams
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
     * @ORM\Column(name="product_id", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     */
    private $productId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="order", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $order;

    /**
     * @var Products
     *
     * @ORM\ManyToOne(targetEntity="Api\Entity\Products", inversedBy="modificationParams")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $product;


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
     * Set productId
     *
     * @param integer $productId
     *
     * @return SubproductParams
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get productId
     *
     * @return integer
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return SubproductParams
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
     * Set order
     *
     * @param integer $order
     *
     * @return SubproductParams
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
     * Set product
     *
     * @param Products $product
     *
     * @return SubproductParams
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
}

