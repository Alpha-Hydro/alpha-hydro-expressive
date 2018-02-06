<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2018, Alpha-Hydro
 *
 */

namespace Admin\Action\Catalog;

use Api\Entity\Categories;
use Catalog\Service\CategoriesService;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Router\RouteResult;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;

class AdminCatalogCategoryAction implements ServerMiddlewareInterface
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
     * @var CategoriesService
     */
    private $categoriesService;

    /**
     * PipelineLendingPageAction constructor.
     * @param TemplateRendererInterface $templateRenderer
     * @param EntityManager $entityManager
     */
    public function __construct(TemplateRendererInterface $templateRenderer, EntityManager $entityManager, CategoriesService $categoriesService)
    {
        $this->templateRenderer = $templateRenderer;
        $this->entityManager = $entityManager;
        $this->categoriesService = $categoriesService;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $queryParams = $request->getQueryParams();

        /** @var RouteResult $routeResult */
        $routeResult = $request->getAttribute(RouteResult::class);
        $routeMatchedParams = $routeResult->getMatchedParams();

        $categoryId = ($routeMatchedParams['id']) ? $routeMatchedParams['id'] : 0;

        /** @var Categories $category */
        $category = ($categoryId != 0) ? $this->entityManager
            ->getRepository(Categories::class)
            ->find($categoryId) : null;

        $categories = $this->entityManager->getRepository(Categories::class)
            ->findByNoDeleted($categoryId);

        $data = [];
        if (!empty($categories)){
            $paginatorAdapter = new ArrayAdapter($categories);
            $paginator = new Paginator($paginatorAdapter);
            $paginator->setDefaultItemCountPerPage(15);

            $page = ($queryParams['page']) ? $queryParams['page'] : 1;
            $paginator->setCurrentPageNumber($page);


            if ($category != null){
                $data['breadcrumb'] = $this->categoriesService->getBreadcrumb($category->getParent());
            }

            $data = [
                'currentCategory' => $category,
                'itemList' => $paginator->getCurrentItems(),
                'currentPageNumber' => $paginator->getCurrentPageNumber(),
                'total' => $paginator->getTotalItemCount()
            ];
        }

        return new HtmlResponse($this->templateRenderer->render('admin::catalog/catalog-category-list', $data));
    }
}