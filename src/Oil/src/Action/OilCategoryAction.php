<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Oil\Action;

use Api\Entity\OilCategories;
use Api\Entity\Pages;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Router\RouteResult;
use Zend\Expressive\Template\TemplateRendererInterface;

class OilCategoryAction implements ServerMiddlewareInterface
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

    /**
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     * @return ResponseInterface|HtmlResponse
     * @throws \Doctrine\ORM\ORMException
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        /** @var RouteResult $routeResult */
        $routeResult = $request->getAttribute(RouteResult::class);

        $routeMatchedParams = $routeResult->getMatchedParams();

        if (empty($routeMatchedParams['path'])) {
            throw new \RuntimeException('Invalid route: "path" not set in matched route params.');
        }

        $path = $routeMatchedParams['path'];

        /** @var OilCategories $currentCategory */
        $currentCategory = $this->entityManager
            ->getRepository(OilCategories::class)
            ->findOneByPath($path);

        /** @var Collection $categories */
        $categories = $this->entityManager
            ->getRepository(OilCategories::class)
            ->findByActiveNoDeleted();

        $page = $this->entityManager->getRepository(Pages::class)
            ->findOneByPath('oil');

        $data = [
            'page' => $page,
            'sidebarListItem' => $categories,
        ];

        if (!$currentCategory)
            return $delegate->process($request->withAttribute(self::class, $data));

        $data['currentCategory'] = $currentCategory;

        $oilList = $currentCategory->getOils();
        $data['oilList'] = $oilList;

        return new HtmlResponse($this->templateRenderer->render('oil::listOil', $data));
    }
}