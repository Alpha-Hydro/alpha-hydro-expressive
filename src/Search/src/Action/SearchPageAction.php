<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 02.02.2018
 * Time: 1:01
 */

namespace Search\Action;

use Api\Entity\Products;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class SearchPageAction implements ServerMiddlewareInterface
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

        $queryParams = $request->getQueryParams();

        /** @var Products[] $resultSearch */
        $resultSearch = $this->entityManager->getRepository(Products::class)
            ->searchSqlQuery($queryParams['query']);

        $data = [];
        foreach ($resultSearch as $item)
            $data['products'][] = [
                'name' => $item->getName(),
                'sku' => $item->getSku(),
                'path' => $item->getFullPath(),
            ];

        if ($request->hasHeader('X-Requested-With'))
            return new JsonResponse($data);

        return new HtmlResponse($this->templateRenderer->render('search::search-page', ['productList' => $resultSearch]));
    }
}