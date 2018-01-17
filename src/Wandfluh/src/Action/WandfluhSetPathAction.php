<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2018, Alpha-Hydro
 *
 */

namespace Wandfluh\Action;

use Api\Entity\WfCategory;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Wandfluh\Service\WandfluhCategoryService;
use Zend\Diactoros\Response\JsonResponse;

class WandfluhSetPathAction implements ServerMiddlewareInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var WandfluhCategoryService
     */
    private $wandfluhService;

    /**
     * WandfluhSetPathAction constructor.
     * @param EntityManager $entityManager
     * @param WandfluhCategoryService $wandfluhService
     */
    public function __construct(EntityManager $entityManager, WandfluhCategoryService $wandfluhService)
    {
        $this->entityManager = $entityManager;
        $this->wandfluhService = $wandfluhService;
    }


    /**
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     * @return ResponseInterface|JsonResponse
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $this->wandfluhService->createPathCategory();

        $categories = $this->entityManager->getRepository(WfCategory::class)
            ->findAll();

        $data = [];
        /**@var WfCategory[] $categories*/
        foreach ($categories as $category) {
            $data[$category->getName()] = $category->getFullPath();
        }

        return new JsonResponse($data);
    }
}