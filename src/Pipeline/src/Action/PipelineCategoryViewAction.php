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
use Api\Entity\Pipeline;
use Api\Entity\PipelineCategories;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router\RouteResult;
use Zend\Expressive\Template\TemplateRendererInterface;

class PipelineCategoryViewAction implements ServerMiddlewareInterface
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
     * PipelineCategoryViewAction constructor.
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

        if (empty($routeMatchedParams['path'])) {
            throw new \RuntimeException('Invalid route: "path" not set in matched route params.');
        }

        $path = $routeMatchedParams['path'];

        /** @var PipelineCategories $currentCategory */
        $currentCategory = $this->entityManager
            ->getRepository(PipelineCategories::class)
            ->findOneByPath($path);

        if (!$currentCategory)
            return new HtmlResponse($this->templateRenderer->render('error::404'), 404);

        $categories = $this->entityManager->getRepository(PipelineCategories::class)
            ->findByActiveNoDeleted();

        $pipelineList = $currentCategory->getPipelines();
        $pipelineListWithProperties = [];
        foreach ($pipelineList as $pipeline){
            $propertyValues = $this->entityManager->getRepository(Pipeline::class)
                ->findPropertyValuesAnyPipeline($pipeline->getId());
            $pipelineListWithProperties[$pipeline->getId()]['pipeline'] = $pipeline;
            $pipelineListWithProperties[$pipeline->getId()]['properties'] = $propertyValues;
        }

        $data = [
            'page' => $this->entityManager->getRepository(Pages::class)
                ->findOneByPath('pipeline'),
            'currentCategory' => $currentCategory,
            'sidebarListItem' => $categories,
            'pipelineList' => $pipelineListWithProperties,
        ];

        return new HtmlResponse($this->templateRenderer->render('pipeline::listPipeline', $data));

    }
}