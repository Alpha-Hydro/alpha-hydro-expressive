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
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router\RouteResult;
use Zend\Expressive\Template;

class ProductAction implements ServerMiddlewareInterface
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
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     *
     * @return ResponseInterface
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

        /** @var Products $product */
        $product = $this->entityManager
            ->getRepository(Products::class)
            ->findOneByFullPath($fullPath);

        if (!$product)
            return new HtmlResponse($this->templateRenderer->render('error::404'), 404);

        $currentCategory = $product->getCategory();
        $parentCategory = $currentCategory->getParent();
        $categoryList = $parentCategory->getChildren();

        $data = [
            'currentCategory' => $currentCategory,
            'sidebarListCategories' => $categoryList,
            'parentCategory' => $parentCategory,
            'product' => $product,
            'breadcrumb' => $this->getBreadcrumb($currentCategory),
        ];

        return new HtmlResponse($this->templateRenderer->render('catalog::viewProduct', $data));
    }

    private function getBreadcrumb(Categories $categories, &$result = []){
        if ($categories == null)
            return null;

        $result[] = $categories;
        if ($categories->getParent() != null)
            $this->getBreadcrumb($categories->getParent(), $result);

        return array_reverse($result);
    }
}