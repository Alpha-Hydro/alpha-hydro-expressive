<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Catalog\Middleware;

use Api\Entity\Categories;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Router\RouteResult;

class FullPathMiddleware implements MiddlewareInterface
{

    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Doctrine\ORM\ORMException
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        // do something and return a response, or
        // delegate to another handler capable of
        // returning a response via:
        //
        /** @var RouteResult $routeResult */
        $routeResult = $request->getAttribute(RouteResult::class);

        $routeMatchedParams = $routeResult->getMatchedParams();

        if (empty($routeMatchedParams['full_path'])) {
            return $delegate->process($request);
        }

        $fullPath = $routeMatchedParams['full_path'];

        /** @var Categories $currentCategory */
        $category = $this->entityManager
            ->getRepository(Categories::class)
            ->findOneByFullPath($fullPath);

        $categoryId = $category->getId();

        // @Todo if $category is Null

        //var_dump($request->getAttribute('full_path'));

        return $delegate->process($request->withAttribute(self::class, $categoryId));
    }
}