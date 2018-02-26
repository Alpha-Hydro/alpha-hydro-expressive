<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 02.02.2018
 * Time: 1:01
 */

namespace Search\Action;

use Api\Entity\Categories;
use Api\Entity\Products;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;

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

    /**
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     * @return \Psr\Http\Message\ResponseInterface|HtmlResponse|JsonResponse
     * @throws \Doctrine\ORM\ORMException
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {

        $queryParams = $request->getQueryParams();

        /** @var Products[] $resultSearch */
        $resultSearch = $this->entityManager->getRepository(Products::class)
            ->searchSqlQuery($queryParams['query']);

        $data = [];
        if ($resultSearch){
            $adapter = new ArrayAdapter($resultSearch);
            $paginator = new Paginator($adapter);
            $paginator->setDefaultItemCountPerPage(12);

            $page = ($queryParams['page']) ? $queryParams['page'] : 1;
            $paginator->setCurrentPageNumber($page);

            if ($request->hasHeader('X-Requested-With')){
                $paginator->setCurrentPageNumber(1);
            }

            $data = [
                'productList' => $paginator->getCurrentItems(),
                'currentPageNumber' => $paginator->getCurrentPageNumber(),
                'total' => $paginator->getTotalItemCount()
            ];
        }

        if ($request->hasHeader('X-Requested-With'))
            return new JsonResponse($data);

        $catalogCategories = $this->entityManager->getRepository(Categories::class)
            ->findByActiveNoDeleted(null);

        $data['catalogCategories'] =  $catalogCategories;

        return new HtmlResponse($this->templateRenderer->render('search::search-page', $data));
    }
}