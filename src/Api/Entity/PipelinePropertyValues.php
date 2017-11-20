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
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="property_id", type="integer", nullable=false)
     */
    private $propertyId;

    /**
     * @var integer
     *
     * @ORM\Column(name="pipeline_id", type="integer", nullable=false)
     */
    private $pipelineId;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text", length=65535, nullable=true)
     */
    private $value;


}

