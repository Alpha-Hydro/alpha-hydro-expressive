<?php

namespace Api\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PipelineProperty
 *
 * @ORM\Table(name="pipeline_property", uniqueConstraints={@ORM\UniqueConstraint(name="unique_id", columns={"id"}), @ORM\UniqueConstraint(name="unique_sistem_name", columns={"sistem_name"})})
 * @ORM\Entity
 */
class PipelineProperty
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
     * @var integer
     *
     * @ORM\Column(name="sorting", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $sorting;

    /**
     * @var integer
     *
     * @ORM\Column(name="show_list", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $showList;

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
     * @ORM\Column(name="sistem_name", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $sistemName;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $type;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Api\Entity\PipelinePropertyValues", mappedBy="pipelineProperty")
     */
    private $propertyValues;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->propertyValues = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return PipelineProperty
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
     * Set sorting
     *
     * @param integer $sorting
     *
     * @return PipelineProperty
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
     * Set showList
     *
     * @param integer $showList
     *
     * @return PipelineProperty
     */
    public function setShowList($showList)
    {
        $this->showList = $showList;

        return $this;
    }

    /**
     * Get showList
     *
     * @return integer
     */
    public function getShowList()
    {
        return $this->showList;
    }

    /**
     * Set active
     *
     * @param integer $active
     *
     * @return PipelineProperty
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
     * @return PipelineProperty
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
     * Set sistemName
     *
     * @param string $sistemName
     *
     * @return PipelineProperty
     */
    public function setSistemName($sistemName)
    {
        $this->sistemName = $sistemName;

        return $this;
    }

    /**
     * Get sistemName
     *
     * @return string
     */
    public function getSistemName()
    {
        return $this->sistemName;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return PipelineProperty
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add propertyValue
     *
     * @param PipelinePropertyValues $propertyValue
     *
     * @return PipelineProperty
     */
    public function addPropertyValue(PipelinePropertyValues $propertyValue)
    {
        $this->propertyValues[] = $propertyValue;

        return $this;
    }

    /**
     * Remove propertyValue
     *
     * @param PipelinePropertyValues $propertyValue
     */
    public function removePropertyValue(PipelinePropertyValues $propertyValue)
    {
        $this->propertyValues->removeElement($propertyValue);
    }

    /**
     * Get propertyValues
     *
     * @return Collection
     */
    public function getPropertyValues()
    {
        return $this->propertyValues;
    }
}

