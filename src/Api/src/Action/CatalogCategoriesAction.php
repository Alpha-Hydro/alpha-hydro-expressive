<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2018, Alpha-Hydro
 *
 */

namespace Api\Action;

use Api\Entity\Categories;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class CatalogCategoriesAction implements ServerMiddlewareInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * CatalogCategoriesAction constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     * @return JsonResponse
     * @throws \Doctrine\ORM\ORMException
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $queryParams = $request->getQueryParams();
        $data = [];

        $categoriesRepository = $this->entityManager->getRepository(Categories::class);

        $categories = $categoriesRepository->findBy(
            [
                'active' => 1,
                'deleted' => 0,
            ]
        );

        if ($queryParams['countChild']){
            $categories = $categoriesRepository
                ->findCategoriesByCountChildren($queryParams['countChild']);

            /** @var Categories[] $categories */
            foreach ($categories as $category){
                $data[] = [
                    'id' => $category->getId(),
                    'name' => $category->getName(),
                ];
            }
        }

        if ($queryParams['double']){
            foreach ($categories as $category){
                $name = $category->getName();

                /** @var Categories $child */
                foreach ($category->getChildren() as $child){
                    if ($child->getName() == $name)
                        $data[] = [
                            'id' => $category->getId(),
                            'name' => $category->getName()
                        ];
                }
            }
        }



        return new JsonResponse($data);
    }
}