<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

use Media\Action;
use Zend\Expressive\Application;

/** @var Application $app */
$app->get('/{media:news|article|action}', Action\NewsListAction::class, 'media.list');
$app->get('/{media:news|article|action}/{post:[\w\-\_]+}', Action\NewsViewAction::class, 'media.view');


