<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

use Manufacture\Action;
use Zend\Expressive\Application;

/** @var Application $app */
$app->get('/manufacture', Action\ManufactureLendingPageAction::class, 'manufacture_lending');
$app->get('/manufacture/{path:[\w]+}', Manufacture\Action\ManufactureListCategoriesAction::class, 'manufacture_category_list' );
$app->get('/manufacture/{full_path:[\w\-\/]+}', Manufacture\Action\ManufactureViewAction::class, 'manufacture_view' );