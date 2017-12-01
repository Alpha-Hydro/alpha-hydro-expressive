<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Oil\Action;

use Api\Entity\Oil;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router\RouteResult;
use Zend\Expressive\Template\TemplateRendererInterface;

class OilViewAction implements ServerMiddlewareInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $templateRenderer;

    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager, TemplateRendererInterface $templateRenderer = null)
    {
        $this->entityManager = $entityManager;
        $this->templateRenderer = $templateRenderer;
    }


    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        /** @var RouteResult $routeResult */
        $routeResult = $request->getAttribute(RouteResult::class);

        $routeMatchedParams = $routeResult->getMatchedParams();

        if (empty($routeMatchedParams['path'])) {
            throw new \RuntimeException('Invalid route: "path" not set in matched route params.');
        }

        $path = $routeMatchedParams['path'];

        /** @var Oil $product */
        $product = $this->entityManager
            ->getRepository(Oil::class)
            ->findOneByPath($path);

        if (!$product)
            return new HtmlResponse($this->templateRenderer->render('error::404'), 404);

        $data = $request->getAttribute(OilCategoryAction::class);

        $data['product'] = $product;
        $data['currentCategory'] = $product->getCategory();

        return new HtmlResponse($this->templateRenderer->render('oil::viewOil', $data));

    }
}