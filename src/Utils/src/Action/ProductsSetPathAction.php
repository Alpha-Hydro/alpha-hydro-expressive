<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 11.03.2018
 * Time: 16:12
 */

namespace Utils\Action;

use Api\Entity\Products;
use Catalog\Service\ProductService;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class ProductsSetPathAction implements ServerMiddlewareInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;


    /**
     * @var ProductService
     */
    private $productService;

    /**
     * ProductsSetPathAction constructor.
     * @param EntityManager $entityManager
     * @param ProductService $productService
     */
    public function __construct(EntityManager $entityManager, ProductService $productService)
    {
        $this->entityManager = $entityManager;
        $this->productService = $productService;
    }


    /**
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     * @return ResponseInterface|JsonResponse
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $this->productService->createPathProducts();

        $products = $this->entityManager
            ->getRepository(Products::class)
            ->findAll();

        $data = [];

        /**@var Products[] $products*/
        foreach ($products as $product)
            $data[$product->getName()] = [
                $product->getFullPath(),
                $product->getCategory()->getFullPath()
            ];

        return new JsonResponse($data);
    }
}