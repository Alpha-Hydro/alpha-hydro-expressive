<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Catalog\Action;

use Api\Entity\Categories;
use Api\Entity\Products;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Router\RouteResult;
use Zend\Expressive\Template;


class CatalogCategoryListAction implements ServerMiddlewareInterface
{

    /**
     * @var Template\TemplateRendererInterface
     */
    private $templateRenderer;

    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager, Template\TemplateRendererInterface $templateRenderer = null)
    {
        $this->entityManager = $entityManager;
        $this->templateRenderer = $templateRenderer;
    }


    /**
     * Process an incoming server request and return a response, optionally delegating
     * to the next middleware component to create the response.
     *
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     *
     *
     * @return ResponseInterface|HtmlResponse
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

        //Находим по переданному параметру текущую категорию
        /** @var Categories $currentCategory */
        $currentCategory = $this->entityManager
            ->getRepository(Categories::class)
            ->findOneByFullPath($fullPath);


        // Если категория не найдена, то возможно это продукт
        // Передаем параметр далее по "трубопроводу"
        // (делегируем следующему Middleware, указанному в config.routes, в нашем случае ProductAction)
        if (!$currentCategory)
            return $delegate->process($request);


        //Получаем список категорий в текущей категории
        $categoriesList = $currentCategory->getChildren();


        $productList = null;
        if ($categoriesList->count() == 0){
            $productList = $currentCategory->getProducts();
        }


        $sidebarListCategories = $categoriesList;

        $parentId = $currentCategory->getId();

        if ($parentId != 0) {
            $parentCategory = $this->entityManager->getRepository(Categories::class)->find($parentId);
            $sidebarListCategories = $this->entityManager->getRepository(Categories::class)->findBy(
                [
                    'parentId' => $parentCategory->getParentId(),
                    'active' => 1,
                    'deleted' => 0,
                ],
                ['sorting' => 'ASC']
            );
        }

        // @Todo if empty Categories

        $parentCategory = (isset($parentCategory) && $parentCategory->getParentId() != 0)
            ? $this->entityManager->getRepository(Categories::class)->find($parentCategory->getParentId())
            : null;

        $data = [
            'currentCategory' => $currentCategory,
            'categories' => $categoriesList,
            'sidebarListCategories' => $sidebarListCategories,
            'parentCategory' => $parentCategory,
            'productList' => $productList,
        ];

        //var_dump($request->getAttribute('categoryId'));

        return new HtmlResponse($this->templateRenderer->render('catalog::listCategory', $data));
    }
}