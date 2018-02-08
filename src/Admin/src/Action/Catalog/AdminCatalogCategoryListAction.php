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
use Doctrine\Common\Collections\Criteria;
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

class AdminCatalogCategoryListAction implements ServerMiddlewareInterface
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

        /** @var Categories $currentCategory */
        $currentCategory = $this->entityManager
            ->getRepository(Categories::class)
            ->find($routeMatchedParams['id']);

        if(!$currentCategory)
            return new HtmlResponse($this->templateRenderer->render('error::404'), 404);



        //Получаем список категорий в текущей категории
        $categoriesList = $currentCategory->getChildren();

        $data = [];
        if ($categoriesList->count() != 0){
            $paginatorAdapter = new ArrayAdapter($categoriesList->toArray());
            $paginator = new Paginator($paginatorAdapter);
            $paginator->setDefaultItemCountPerPage(15);

            $page = ($queryParams['page']) ? $queryParams['page'] : 1;
            $paginator->setCurrentPageNumber($page);

            $data = [
                'itemList' => $paginator->getCurrentItems(),
                'currentPageNumber' => $paginator->getCurrentPageNumber(),
                'total' => $paginator->getTotalItemCount()
            ];
        }
        $data['currentCategory'] = $currentCategory;

        $parentCategory = $currentCategory->getParent();
        $data['breadcrumb'] = $this->categoriesService->getBreadcrumb($parentCategory);

        return new HtmlResponse($this->templateRenderer->render('admin::catalog/catalog-category-list', $data));
    }
}