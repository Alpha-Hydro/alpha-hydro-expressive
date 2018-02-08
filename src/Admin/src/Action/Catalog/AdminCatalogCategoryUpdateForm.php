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
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Router\RouteResult;
use Zend\Expressive\Template\TemplateRendererInterface;


class AdminCatalogCategoryUpdateForm implements ServerMiddlewareInterface
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
     * PipelineLendingPageAction constructor.
     * @param TemplateRendererInterface $templateRenderer
     * @param EntityManager $entityManager
     */
    public function __construct(TemplateRendererInterface $templateRenderer, EntityManager $entityManager)
    {
        $this->templateRenderer = $templateRenderer;
        $this->entityManager = $entityManager;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        /** @var RouteResult $routeResult */
        $routeResult = $request->getAttribute(RouteResult::class);

        $routeMatchedParams = $routeResult->getMatchedParams();

        if (empty($routeMatchedParams['id']))
            throw new \RuntimeException('Invalid route: "id" not set in matched route params.');

        $category = $this->entityManager
            ->getRepository(Categories::class)
            ->find($routeMatchedParams['id']);

        if (!$category)
            return new HtmlResponse($this->templateRenderer->render('error::404'), 404);

        if ($request->getParsedBody())
            return $delegate->process($request);

        $rootCategories = $this->entityManager
            ->getRepository(Categories::class)
            ->findByParentNull();

        $data = [
            'category' => $category,
            'rootCategories' => $rootCategories
        ];

        return new HtmlResponse($this->templateRenderer
            ->render('admin::catalog/catalog-category-update-form', $data));
    }
}