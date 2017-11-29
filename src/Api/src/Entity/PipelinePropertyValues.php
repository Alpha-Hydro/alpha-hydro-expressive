<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PipelinePropertyValues
 *
 * @ORM\Table(name="pipeline_property_values", indexes={@ORM\Index(name="property_id", columns={"property_id"}), @ORM\Index(name="pipeline_id", columns={"pipeline_id"})})
 * @ORM\Entity
 */
class PipelinePropertyValues
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
     * @ORM\Column(name="property_id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $propertyId;

    /**
     * @var integer
     *
     * @ORM\Column(name="pipeline_id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $pipelineId;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $value;

    /**
     * @var PipelineProperty
     *
     * @ORM\ManyToOne(targetEntity="Api\Entity\PipelineProperty", inversedBy="propertyValues")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="property_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $pipelineProperty;

    /**
     * @var Pipeline
     *
     * @ORM\ManyToOne(targetEntity="Api\Entity\Pipeline", inversedBy="propertyValues")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pipeline_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $pipeline;


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
     * Set propertyId
     *
     * @param integer $propertyId
     *
     * @return PipelinePropertyValues
     */
    public function setPropertyId($propertyId)
    {
        $this->propertyId = $propertyId;

        return $this;
    }

    /**
     * Get propertyId
     *
     * @return integer
     */
    public function getPropertyId()
    {
        return $this->propertyId;
    }

    /**
     * Set pipelineId
     *
     * @param integer $pipelineId
     *
     * @return PipelinePropertyValues
     */
    public function setPipelineId($pipelineId)
    {
        $this->pipelineId = $pipelineId;

        return $this;
    }

    /**
     * Get pipelineId
     *
     * @return integer
     */
    public function getPipelineId()
    {
        return $this->pipelineId;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return PipelinePropertyValues
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
     * Set pipelineProperty
     *
     * @param PipelineProperty $pipelineProperty
     *
     * @return PipelinePropertyValues
     */
    public function setPipelineProperty(PipelineProperty $pipelineProperty = null)
    {
        $this->pipelineProperty = $pipelineProperty;

        return $this;
    }

    /**
     * Get pipelineProperty
     *
     * @return PipelineProperty
     */
    public function getPipelineProperty()
    {
        return $this->pipelineProperty;
    }

    /**
     * Set pipeline
     *
     * @param Pipeline $pipeline
     *
     * @return PipelinePropertyValues
     */
    public function setPipeline(Pipeline $pipeline = null)
    {
        $this->pipeline = $pipeline;

        return $this;
    }

    /**
     * Get pipeline
     *
     * @return Pipeline
     */
    public function getPipeline()
    {
        return $this->pipeline;
    }
}

