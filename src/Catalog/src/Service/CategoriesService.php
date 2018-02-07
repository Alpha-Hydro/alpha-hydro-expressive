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
use Api\Service\ServiceInterface;
use Doctrine\ORM\EntityManager;
use Utils\Slugify;

class CategoriesService implements ServiceInterface
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

    public function getBreadcrumb(Categories $category = null){
        if ($category == null)
            return null;

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

    public function generateFullPath(Categories $category)
    {
        $result = [];
        $array = $this->getBreadcrumb($category);
        foreach ($array as $item)
            $result[] = $item->getPath();

        return trim(implode('/',$result));
    }

    /**
     * @param $data
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create($data)
    {
        $category = new Categories();
        $currentDate = new \DateTime('now');
        $category->setAddDate($currentDate);
        $category->setModDate($currentDate);

        $category->setName($data['category']['name']);
        $category->setUploadPath($data['category']['uploadPath']);
        $category->setImage($data['category']['image']);
        // TODO: upload image

        $slugify = new Slugify();
        $category->setPath($slugify->filter($data['category']['name']));
        //$category->setFullPath($this->generateFullPath($category));
        $category->setFullPath($slugify->filter($data['category']['name']));

        $category->setDescription($data['category']['description']);

        if ($data['category']['contentMarkdown'] && $data['category']['contentMarkdown'] != ''){
            $category->setContentMarkdown($data['category']['contentMarkdown']);
            // TODO: $category->setContentHtml()
        }

        $category->setMetaTitle(
            ($data['category']['metaTitle'])
                ? $data['category']['metaTitle']
                : $data['category']['name']);
        $category->setMetaDescription($data['category']['metaDescription']);
        $category->setMetaKeywords($data['category']['metaKeywords']);

        if ($data['category']['parent']){
            $category->setParent(
                $this->entityManager
                    ->getRepository(Categories::class)
                    ->find($data['category']['parent'])
            );
        }
        else {
            $category->setParentId(0);
        }

        $category->setActive(1);
        $category->setDeleted(0);
        $category->setSorting(($data['category']['sorting']) ? $data['category']['sorting']: 0);

        $this->entityManager->persist($category);
        $this->entityManager->flush();
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