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