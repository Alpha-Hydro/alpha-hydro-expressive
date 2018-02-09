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
     * @var Slugify
     */
    private $slugifyFilter;

    /**
     * AdsService constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager, Slugify $slugify)
    {
        $this->entityManager = $entityManager;
        $this->slugifyFilter = $slugify;
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
     * @param array $data
     * @param null | integer $id
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save($data, $id = null)
    {
        $currentDate = new \DateTime('now');
        if ($id == null){
            $category = new Categories();
            $category->setAddDate($currentDate);
        }
        else{
            $category = $this->entityManager->getRepository(Categories::class)
                ->find($id);
        }
        $category->setModDate($currentDate);

        $category->setName($data['category']['name']);

        $category->setUploadPath($data['category']['uploadPath']);
        $category->setImage($data['category']['image']);
        // TODO: upload image

        if ($data['category']['parent'] && $data['category']['parent'] != 0){
            $category->setParent(
                $this->entityManager
                    ->getRepository(Categories::class)
                    ->find($data['category']['parent'])
            );
        }
        else{
            $category->setParent(null);
        }

        $this->slugifyFilter->setSeparator('-');
        $category->setPath($this->slugifyFilter->filter($data['category']['name']));
        $category->setFullPath($this->generateFullPath($category));

        // TODO: recursive setFullPath by children items
        // TODO: setPath and setFullPath by hand
        /*$category->setPath(
            ($data['category']['path'])
                ? $data['category']['path']
                : $this->slugifyFilter->filter($data['category']['name'])
        );
        $category->setFullPath(
            ($data['category']['fullPath'])
                ? $data['category']['fullPath']
                : $this->generateFullPath($category)
        );*/

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

        $category->setActive(($data['category']['active']) ? $data['category']['active'] : 1);
        $category->setDeleted(($data['category']['deleted']) ? $data['category']['deleted']: 0);
        $category->setSorting(($data['category']['sorting']) ? $data['category']['sorting']: 0);

        $this->entityManager->persist($category);
        $this->entityManager->flush();
    }

    /**
     * @param $id
     * @param $data
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update($id, $data)
    {
        $this->save($data, $id);
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param $id
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function disable($id)
    {
        /** @var Categories $category */
        $category = $this->entityManager->getRepository(Categories::class)
            ->find($id);

        $category->setActive(0)->setSorting(1000);

        // TODO: recursive disabled children categories

        $this->entityManager->persist($category);
        $this->entityManager->flush();
    }

    /**
     * @param $id
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function enable($id)
    {
        /** @var Categories $category */
        $category = $this->entityManager->getRepository(Categories::class)
            ->find($id);

        $category->setActive(1)->setSorting(0);

        // TODO: recursive enabled children categories

        $this->entityManager->persist($category);
        $this->entityManager->flush();
    }
}