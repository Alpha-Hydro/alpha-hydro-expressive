<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Manufacture\Action;

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

class ManufactureListCategoriesAction implements ServerMiddlewareInterface
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
     * ManufactureListCategoriesAction constructor.
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
     * @return ResponseInterface
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

        //Находим по переданному параметру текущую категорию
        /** @var ManufactureCategories $currentCategory */
        $currentCategory = $this->entityManager
            ->getRepository(ManufactureCategories::class)
            ->findOneByPath($path);

        if (!$currentCategory)
            return new HtmlResponse($this->templateRenderer->render('error::404'), 404);

        $manufactureList = $currentCategory->getManufactures();

        $categories = $this->entityManager->getRepository(ManufactureCategories::class)->findBy(
            [
                'parentId' => 0,
                'active' => 1,
                'deleted' => 0,
            ],
            ['sorting' => 'ASC']
        );

        $data = [
            'currentCategory' => $currentCategory,
            'sidebarListItem' => $categories,
            'manufactureList' => $manufactureList
        ];

        return new HtmlResponse($this->templateRenderer->render('manufacture::listManufacture',$data));
    }
}