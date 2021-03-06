<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
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

class CatalogGroupForXLS implements ServerMiddlewareInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * CatalogGroupForXLS constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $categories = $this->entityManager->getRepository(Categories::class)
        ->findBy(
            [
                'active' => 1,
                'deleted' => 0,
            ],
            ['parentId' => 'ASC']
        );

        $data = [];

        /** @var Categories $category */
        foreach ($categories as $category){

            if ($category->getChildren()->count() === 0){
                $array = [];
                $name = $category->getName();
                $k = 0;
                $array[$k] = $name;
                $parent = $category->getParent();
                while ($parent != null){
                    $k++;
                    $array[$k] = $parent->getName();
                    $parent = $parent->getParent();
                }
                $data[] = array_reverse($array);
            }
        }

        return new JsonResponse($data);
    }
}