<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2018, Alpha-Hydro
 *
 */

namespace Wandfluh\Service;


use Api\Entity\WfCategory;
use Api\Service\ServiceInterface;
use Doctrine\ORM\EntityManager;
use Utils\Slugify;

class WandfluhCategoryService implements ServiceInterface
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
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createPathCategory(){
        /**@var WfCategory[] $categories*/
        $categories = $this->entityManager->getRepository(WfCategory::class)
            ->findAll();

        foreach ($categories as $category) {
            if ($category->getPath() == null){
                $slugify = new Slugify();
                $category->setPath($slugify->filter($category->getName()));
            }

            $fullPath = $this->generateFullPath($category);
            $category->setFullPath($fullPath);

            $this->entityManager->persist($category);
        }

        $this->entityManager->flush();
    }

    /**
     * @param WfCategory $category
     * @return null|string
     */
    public function generateFullPath(WfCategory $category)
    {
        $result = [];
        do{
            $result[] = $category->getPath();
            $category = $category->getParent();
        }
        while($category != null);

        if (!empty($result))
            $result = array_reverse($result);

        return trim(implode('/',$result));
    }


}