<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2018, Alpha-Hydro
 *
 */

namespace Admin\Action\Catalog;

use Catalog\Service\CategoriesService;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class AdminCatalogCategoryUpdatePost implements ServerMiddlewareInterface
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
     * @var RouterInterface
     */
    private $router;


    /**
     * @var CategoriesService
     */
    private $categoriesService;

    /**
     * PipelineLendingPageAction constructor.
     * @param TemplateRendererInterface $templateRenderer
     * @param EntityManager $entityManager
     * @param CategoriesService $categoriesService
     * @param RouterInterface $router
     */
    public function __construct(
        TemplateRendererInterface $templateRenderer,
        EntityManager $entityManager,
        CategoriesService $categoriesService,
        RouterInterface $router
    )
    {
        $this->templateRenderer = $templateRenderer;
        $this->entityManager = $entityManager;
        $this->categoriesService = $categoriesService;
        $this->router = $router;
    }

    /**
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     * @return RedirectResponse|ResponseInterface
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $id = $request->getAttribute('id');
        $parsedBody = $request->getParsedBody();

        $this->categoriesService->update($id, $parsedBody);

        //return new RedirectResponse($this->router->generateUri('admin.catalog.category'));
        return new RedirectResponse($request->getHeaderLine('referer'));
    }
}