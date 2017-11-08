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
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
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
     * @return HtmlResponse
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

        /** @var Categories $currentCategory */
        $currentCategory = $this->entityManager
            ->getRepository(Categories::class)
            ->findOneByFullPath($fullPath);

        // @Todo if not find currentCategory

        if (!$currentCategory)
            return new HtmlResponse($this->templateRenderer->render('error::404'), 404);

        $parentId = $currentCategory->getId();

        $categories = $this->entityManager->getRepository(Categories::class)->findBy(
            [
                'parentId' => $parentId,
                'active' => 1,
                'deleted' => 0,
            ],
            ['sorting' => 'ASC']
        );

        $sidebarListCategories = $categories;

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
            'categories' => $categories,
            'sidebarListCategories' => $sidebarListCategories,
            'parentCategory' => $parentCategory,
        ];

        //var_dump($request->getAttribute('categoryId'));

        return new HtmlResponse($this->templateRenderer->render('catalog::listCategory', $data));
    }
}