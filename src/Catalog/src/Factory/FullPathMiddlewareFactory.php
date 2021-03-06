<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Catalog\Factory;


use Catalog\Middleware\FullPathMiddleware;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class FullPathMiddlewareFactory
{
    /**
     * @param ContainerInterface $container
     * @param $name
     * @param callable $callback
     * @return FullPathMiddleware
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $name, callable $callback)
    {
        return new FullPathMiddleware($container->get(EntityManager::class));
    }
}