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
use Zend\Diactoros\Response\HtmlResponse;
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
    private $wandfluhService;

    public function __construct(EntityManager $entityManager, TemplateRendererInterface $templateRenderer = null, WandfluhCategoryService $wandfluhCategoryService)
    {
        $this->entityManager = $entityManager;
        $this->templateRenderer = $templateRenderer;
        $this->wandfluhService = $wandfluhCategoryService;
    }

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
            ? $currentCategory->getProducts()
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
            'breadcrumb' => ($parentCategory != null) ? $this->wandfluhService->getBreadcrumb($parentCategory): null,
        ];

        return new HtmlResponse($this->templateRenderer->render('wandfluh::category', $data));
    }
}