<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

use Oil\Action;
use Zend\Expressive\Application;

/** @var Application $app */
$app->get('/oil', Action\OilIndexAction::class, 'oil.index');
$app->get('/oil/{path:[\w]+}', Action\OilCategoryAction::class, 'oil.list');

