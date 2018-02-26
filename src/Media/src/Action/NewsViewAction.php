<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2018, Alpha-Hydro
 *
 */

namespace Media\Action;

use Api\Entity\Media;
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

class NewsViewAction implements ServerMiddlewareInterface
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

        $pathPost = $routeMatchedParams['post'];

        /** @var Media $mediaPost */
        $mediaPost = $this->entityManager
            ->getRepository(Media::class)
            ->findOneByPath($pathPost);

        if (!$mediaPost)
            return new HtmlResponse($this->templateRenderer->render('error::404'), 404);

        $data = [
            'currentCategory' => $mediaPost->getMediaCategory(),
            'post' => $mediaPost,
            'sidebarListItem' => $this->entityManager->getRepository(MediaCategories::class)->findByActiveNoDeleted(),
        ];

        //return new JsonResponse([$mediaPost->getName()]);
        return new HtmlResponse($this->templateRenderer->render('media::mediaView', $data));
    }
}