<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SubproductParamsValues
 *
 * @ORM\Table(name="subproduct_params_values", uniqueConstraints={@ORM\UniqueConstraint(name="subproduct_params_values_id_uindex", columns={"id"})}, indexes={@ORM\Index(name="subproduct_id", columns={"subproduct_id"}), @ORM\Index(name="param_id", columns={"param_id"})})
 * @ORM\Entity
 */
class SubproductParamsValues
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
     * @ORM\Column(name="subproduct_id", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     */
    private $subproductId;

    /**
     * @var integer
     *
     * @ORM\Column(name="param_id", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     */
    private $paramId;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
     */
    private $value;

    /**
     * @var Subproducts
     *
     * @ORM\JoinTable(name="subproducts_params",
     *     inverseJoinColumns={
     *         @ORM\JoinColumn(name="param_id", referencedColumnName="id")
     *     }
     * )
     *
     * @ORM\ManyToOne(targetEntity="Api\Entity\Subproducts", inversedBy="paramValues")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="subproduct_id", referencedColumnName="id")
     * })
     *
     */
    private $subproducts;


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
     * Set subproductId
     *
     * @param integer $subproductId
     *
     * @return SubproductParamsValues
     */
    public function setSubproductId($subproductId)
    {
        $this->subproductId = $subproductId;

        return $this;
    }

    /**
     * Get subproductId
     *
     * @return integer
     */
    public function getSubproductId()
    {
        return $this->subproductId;
    }

    /**
     * Set paramId
     *
     * @param integer $paramId
     *
     * @return SubproductParamsValues
     */
    public function setParamId($paramId)
    {
        $this->paramId = $paramId;

        return $this;
    }

    /**
     * Get paramId
     *
     * @return integer
     */
    public function getParamId()
    {
        return $this->paramId;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return SubproductParamsValues
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
     * Set modification
     *
     * @param Subproducts|null $subproducts
     * @return SubproductParamsValues
     */
    public function setSubproducts(Subproducts $subproducts= null)
    {
        $this->subproducts = $subproducts;

        return $this;
    }

    /**
     * Get modification
     *
     * @return Subproducts
     */
    public function getModification()
    {
        return $this->subproducts;
    }
}

