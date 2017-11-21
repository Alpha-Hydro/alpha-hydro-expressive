<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

use Pipeline\Action;
use Zend\Expressive\Application;

/** @var Application $app */
$app->get('/pipeline', Action\PipelineLendingPageAction::class, 'pipeline_lending');
$app->get('/pipeline/{path:[\w]+}', Action\PipelineCategoryViewAction::class, 'pipeline_category_list');
$app->get('/pipeline/{full_path:[\w\-\/]+}', Action\PipelineViewAction::class, 'pipeline_view');