<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Pipeline\Action;

use Api\Entity\Pages;
use Api\Entity\PipelineCategories;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class PipelineLendingPageAction implements ServerMiddlewareInterface
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
        /** @var Pages $indexPage */
        $indexPage = $this->entityManager->getRepository(Pages::class)
            ->findByActiveModuleFromPath('pipeline');

        if (!$indexPage)
            return new HtmlResponse($this->templateRenderer
                ->render('error::404'), 404);

        $categories = $this->entityManager->getRepository(PipelineCategories::class)
            ->findByActiveNoDeleted();

        $data = [
            'page' => $indexPage,
            'sidebarListItem' => $categories,
        ];

        return new HtmlResponse($this->templateRenderer
            ->render('pipeline::lendingPipeline', $data));
    }
}