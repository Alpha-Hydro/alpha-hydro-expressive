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
$app->get('/{media:news|articles|actions}', Action\NewsListAction::class, 'news.list');

