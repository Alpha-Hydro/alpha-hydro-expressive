<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Media\Action;

use Api\Entity\MediaCategories;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router\RouteResult;
use Zend\Expressive\Template\TemplateRendererInterface;

class NewsListAction implements ServerMiddlewareInterface
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


//        $routeMatchedPath = $routeResult->getMatchedRoute()->getPath();
//        $path = ltrim($routeMatchedPath, "\/");
//
//        /** @var MediaCategories $mediaCategory */
//        $mediaCategory = $this->entityManager->getRepository(MediaCategories::class)
//            ->findOneByPath($path);R
//
//        if (!$mediaCategory)
//            return new HtmlResponse($this->templateRenderer->render('error::404'), 404);
//
//
//        $mediaPosts = $mediaCategory->getMediaPosts();
//
//        $data = [
//            'currentCategory' => $mediaCategory,
//            'mediaPosts' => $mediaPosts,
//            'sidebarListItem' => $this->entityManager->getRepository(MediaCategories::class)->findByActiveNoDeleted(),
//        ];
//
//        return new HtmlResponse($this->templateRenderer->render('media::newsList', $data));

        return new JsonResponse($routeResult->getMatchedParams());
    }
}