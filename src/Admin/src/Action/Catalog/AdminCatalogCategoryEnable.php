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
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;

class AdminCatalogCategoryEnable implements ServerMiddlewareInterface
{

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
     * @param CategoriesService $categoriesService
     * @param RouterInterface $router
     */
    public function __construct(
        CategoriesService $categoriesService,
        RouterInterface $router
    )
    {
        $this->categoriesService = $categoriesService;
        $this->router = $router;
    }

    /**
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     * @return RedirectResponse
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $id = $request->getAttribute('id');
        $this->categoriesService->enable($id);

        //return new RedirectResponse($this->router->generateUri('admin.catalog.category'));
        return new RedirectResponse($request->getHeaderLine('referer'));
    }
}