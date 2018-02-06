<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2018, Alpha-Hydro
 *
 */

namespace Catalog\Service;


use Api\Entity\Categories;
use Doctrine\ORM\EntityManager;

class CategoriesService
{
    /**
     * Doctrine entity manager.
     * @var EntityManager
     */
    private $entityManager;

    /**
     * AdsService constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getBreadcrumb(Categories $categories = null, &$result = []){
        if ($categories == null)
            return null;

        $result[] = $categories;
        if ($categories->getParent() != null)
            $this->getBreadcrumb($categories->getParent(), $result);

        return array_reverse($result);
    }
}