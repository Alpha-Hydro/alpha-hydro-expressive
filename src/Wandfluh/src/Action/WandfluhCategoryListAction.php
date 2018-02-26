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
use Api\Entity\WfProduct;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Wandfluh\Service\WandfluhCategoryService;
use Wandfluh\Service\WandfluhProductService;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router\RouteResult;
use Zend\Expressive\Template\TemplateRendererInterface;

class WandfluhCategoryListAction implements ServerMiddlewareInterface
{

    /**
     * @var TemplateRendererInterface
     */
    private $templateRenderer;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var WandfluhCategoryService
     */
    private $wandfluhCategoryService;


    /**
     * @var WandfluhProductService
     */
    private $wandfluhProductService;

    public function __construct(EntityManager $entityManager,
                                TemplateRendererInterface $templateRenderer = null,
                                WandfluhCategoryService $wandfluhCategoryService,
                                WandfluhProductService $wandfluhProductService)
    {
        $this->entityManager = $entityManager;
        $this->templateRenderer = $templateRenderer;
        $this->wandfluhCategoryService = $wandfluhCategoryService;
        $this->wandfluhProductService = $wandfluhProductService;
    }

    /**
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     * @return ResponseInterface|HtmlResponse
     * @throws \Doctrine\ORM\ORMException
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        /** @var RouteResult $routeResult */
        $routeResult = $request->getAttribute(RouteResult::class);

        $routeMatchedParams = $routeResult->getMatchedParams();

        if (empty($routeMatchedParams['full_path'])) {
            throw new \RuntimeException('Invalid route: "full_path" not set in matched route params.');
        }

        $fullPath = $routeMatchedParams['full_path'];

        /** @var WfCategory $currentCategory */
        $currentCategory = $this->entityManager->getRepository(WfCategory::class)
            ->findOneByFullPath($fullPath);

        if (!$currentCategory)
            return new HtmlResponse($this->templateRenderer->render('error::404'), 404);

        $categoriesList = $currentCategory->getChildren();

        $productList = ($currentCategory->getProducts()->count() != 0)
            ? $this->wandfluhProductService->groupByControl($currentCategory->getProducts())
            : null;

        $sidebarListItem = $this->entityManager->getRepository(WfCategory::class)
            ->findByActiveNoDeleted();
        $parentCategory = $currentCategory->getParent();
        if ($parentCategory != null)
            $sidebarListItem = $parentCategory->getChildren();

        $data = [
            'currentCategory' => $currentCategory,
            'categories' => $categoriesList,
            'sidebarListItem' => $sidebarListItem,
            'parentCategory' => $parentCategory,
            'productList' => $productList,
            'breadcrumb' => ($parentCategory != null) ? $this->wandfluhCategoryService->getBreadcrumb($parentCategory): null,
        ];

        return new HtmlResponse($this->templateRenderer->render('wandfluh::category', $data));
    }
}