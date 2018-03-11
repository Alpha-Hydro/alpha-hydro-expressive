<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 11.03.2018
 * Time: 16:19
 */

namespace Catalog\Service;


use Api\Entity\Products;
use Doctrine\ORM\EntityManager;
use Utils\Slugify;

class ProductService
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
     * @param Slugify $slugify
     */
    public function __construct(EntityManager $entityManager, Slugify $slugify)
    {
        $this->entityManager = $entityManager;
        $this->slugifyFilter = $slugify;
    }

    /**
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createPathProducts(){
        /**@var Products[] $products*/
        $products = $this->entityManager
            ->getRepository(Products::class)
            ->findAll();

        foreach ($products as $product){
            if ($product->getPath() == null){
                $slugify = new Slugify();
                $product->setPath(strtoupper($slugify->filter($product->getSku())));
            }

            $product->setFullPath($this->generateFullPath($product));

            $this->entityManager->persist($product);
        }

        $this->entityManager->flush();
    }

    /**
     * @param Products $product
     * @return string
     */
    public function generateFullPath(Products $product)
    {
        $categoryProduct = $product->getCategory();
        return ($categoryProduct != null)
            ? $categoryProduct->getFullPath().'/'.$product->getPath()
            : $product->getPath();
    }

}