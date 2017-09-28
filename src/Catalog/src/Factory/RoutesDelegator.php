<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Catalog\Factory;


use Psr\Container\ContainerInterface;

class RoutesDelegator
{
    public function __invoke(ContainerInterface $container, $serviceName, callable $callback)
    {
        $app = $callback();

        include __DIR__ . '/../../config/routes.php';

        return $app;
    }

}