<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2018, Alpha-Hydro
 *
 */

namespace Admin\Action\Catalog;

use Admin\Action\AuthAction;
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

        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq('deleted', 0))
            ->andWhere(Criteria::expr()->eq('parentId', 0))
            ->orWhere(Criteria::expr()->eq('parentId', null))
            ->orderBy(['sorting' => 'ASC']);

        $categories = $this->entityManager->getRepository(Categories::class)
            ->matching($criteria);

        $data = [];
        if (!empty($categories)){
            $paginatorAdapter = new ArrayAdapter($categories->toArray());
            $paginator = new Paginator($paginatorAdapter);
            $paginator->setDefaultItemCountPerPage(17);

            $page = ($queryParams['page']) ? $queryParams['page'] : 1;
            $paginator->setCurrentPageNumber($page);

            $data = [
                'pagination' => $paginator->getPages(),
                'itemList' => $paginator->getCurrentItems(),
                'identity' => $request->getAttribute(AuthAction::class),
            ];
        }

        return new HtmlResponse($this->templateRenderer->render('admin::catalog/catalog-category-list', $data));
    }
}