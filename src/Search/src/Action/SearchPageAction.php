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
use Doctrine\ORM\Query\ResultSetMapping;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router\RouteResult;
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
        $query = str_replace(array('.',',',' ','-','_','/','\\','*','+','&','^','%','#','@','!','(',')','~','<','>',':',';','"',"'","|"), '', $queryParams['query']);
        $sQuery = "MATCH(s_name, sku, name, meta_keywords) AGAINST ('+$query*' IN BOOLEAN MODE)";
        $sql = "SELECT * FROM products p WHERE MATCH (s_name, sku, name, meta_keywords) AGAINST ('+any*' IN BOOLEAN MODE)";

        $rsm = new ResultSetMapping();

        $rsm->addEntityResult(Products::class, 'p');
        $rsm->addFieldResult('p', 'name', 'name');
        $rsm->addFieldResult('p', 'sku', 'sku');

        $nativeQuery = $this->entityManager->createNativeQuery($sql, $rsm);

        $result = $nativeQuery->getResult();

        return new JsonResponse($result);
    }
}