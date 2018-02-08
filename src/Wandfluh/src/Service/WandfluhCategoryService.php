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
     * @return WfCategory[]
     */
    public function getBreadcrumb(WfCategory $category){
        $result = [];
        do{
            $result[] = $category;
            $category = $category->getParent();
        }
        while($category != null);

        if (!empty($result))
            $result = array_reverse($result);

        return $result;
    }

    /**
     * @param WfCategory $category
     * @return null|string
     */
    public function generateFullPath(WfCategory $category)
    {
        $result = [];
        $array = $this->getBreadcrumb($category);
        foreach ($array as $item)
            $result[] = $item->getPath();

        return trim(implode('/',$result));
    }


    public function save($data)
    {
        // TODO: Implement save() method.
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