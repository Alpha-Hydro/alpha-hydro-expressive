<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WfCategoryProperties
 *
 * @ORM\Table(name="wf_category_properties", indexes={@ORM\Index(name="fk_category_properties_category1_idx", columns={"category_id"})})
 * @ORM\Entity
 */
class WfCategoryProperties
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
     * @ORM\Column(name="value", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
     */
    private $value;

    /**
     * @var \Api\Entity\WfCategory
     *
     * @ORM\ManyToOne(targetEntity="Api\Entity\WfCategory", inversedBy="properties")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $category;


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
     * Set value
     *
     * @param string $value
     *
     * @return WfCategoryProperties
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set category
     *
     * @param \Api\Entity\WfCategory $category
     *
     * @return WfCategoryProperties
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
}

