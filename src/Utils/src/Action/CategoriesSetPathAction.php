<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2018, Alpha-Hydro
 *
 */

namespace Utils\Action;

use Api\Entity\Categories;
use Catalog\Service\CategoriesService;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class CategoriesSetPathAction implements ServerMiddlewareInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var CategoriesService
     */
    private $categoriesService;

    /**
     * WandfluhSetPathAction constructor.
     * @param EntityManager $entityManager
     * @param CategoriesService $categoriesService
     */
    public function __construct(EntityManager $entityManager, CategoriesService $categoriesService)
    {
        $this->entityManager = $entityManager;
        $this->categoriesService = $categoriesService;
    }

    /**
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     * @return ResponseInterface|JsonResponse
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $this->categoriesService->createPathCategory();

        $categories = $this->entityManager->getRepository(Categories::class)
            ->findAll();

        $data = [];
        /**@var Categories[] $categories*/
        foreach ($categories as $category) {
            $data[$category->getName()] = $category->getFullPath();
        }

        return new JsonResponse($data);
    }


}