<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2018, Alpha-Hydro
 *
 */

namespace Wandfluh\Service;


use Api\Entity\WfProduct;
use Api\Service\ServiceInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;

class WandfluhProductService implements ServiceInterface
{
    /**
     * Doctrine entity manager.
     * @var EntityManager
     */
    private $entityManager;

    /**
     * WandfluhCategoryService constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Collection $productList
     * @return array
     */
    public function groupByControl(Collection $productList)
    {
        $result = [];
        /** @var WfProduct $product */
        foreach ($productList as $product) {
            $productControl = ($product->getProductControl() != null) ? $product->getProductControl()->getName() : $product->getCategory()->getName();
            $result[$productControl][] = $product;
        }
        return $result;
    }

    public function create($data)
    {
        // TODO: Implement create() method.
    }

    public function update($id, $data)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function disable($id)
    {
        // TODO: Implement disable() method.
    }

    public function enable($id)
    {
        // TODO: Implement enable() method.
    }
}