<?php

namespace Api\Entity;

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
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="sorting", type="integer", nullable=false)
     */
    private $sorting = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="show_list", type="integer", nullable=false)
     */
    private $showList = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="active", type="integer", nullable=false)
     */
    private $active = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="deleted", type="integer", nullable=false)
     */
    private $deleted = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="sistem_name", type="string", length=255, nullable=false)
     */
    private $sistemName = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer", nullable=false)
     */
    private $type = '0';


}

