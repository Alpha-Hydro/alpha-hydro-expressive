<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Manufacture\Action;

use Api\Entity\Manufacture;
use Api\Entity\ManufactureCategories;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router\RouteResult;
use Zend\Expressive\Template\TemplateRendererInterface;

class ManufactureViewAction implements ServerMiddlewareInterface
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
     * ManufactureViewAction constructor.
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

        if (empty($routeMatchedParams['full_path'])) {
            throw new \RuntimeException('Invalid route: "full_path" not set in matched route params.');
        }

        $fullPath = $routeMatchedParams['full_path'];

        /** @var Manufacture $manufacture */
        $manufacture = $this->entityManager->getRepository(Manufacture::class)
            ->findOneByFullPath($fullPath);

        if (!$manufacture)
            return new HtmlResponse($this->templateRenderer->render('error::404'), 404);

        $currentCategory = $manufacture->getManufactureCategory();
        $sidebarListItem = $this->entityManager->getRepository(ManufactureCategories::class)->findBy(
            [
                'parentId' => 0,
                'active' => 1,
                'deleted' => 0,
            ],
            ['sorting' => 'ASC']
        );

        $data = [
            'currentCategory' => $currentCategory,
            'sidebarListItem' => $sidebarListItem,
            'manufacture' => $manufacture,
        ];

        return new HtmlResponse($this->templateRenderer->render('manufacture::viewManufacture', $data));
    }
}