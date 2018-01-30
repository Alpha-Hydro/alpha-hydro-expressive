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
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
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
        $routeMatchedParams = $routeResult->getMatchedParams();

        $pathCategory = $routeMatchedParams['media'];

        /** @var MediaCategories $mediaCategory */
        $mediaCategory = $this->entityManager
            ->getRepository(MediaCategories::class)
            ->findOneByPath($pathCategory);

        if (!$mediaCategory)
            return new HtmlResponse($this->templateRenderer->render('error::404'), 404);


        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq("active", "1"))
            ->andWhere(Criteria::expr()->eq('deleted', "0"))
            ->orderBy(['timestamp' => 'DESC'])
        ;

        /** @var Collection $mediaPosts */
        $mediaPosts = $mediaCategory->getMediaPosts()->matching($criteria);

        $data = [
            'currentCategory' => $mediaCategory,
            'mediaPosts' => $mediaPosts,
            'sidebarListItem' => $this->entityManager->getRepository(MediaCategories::class)->findByActiveNoDeleted(),
        ];

        return new HtmlResponse($this->templateRenderer->render('media::newsList', $data));

    }
}