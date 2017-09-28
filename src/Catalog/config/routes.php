<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

use Catalog\Action;
use Zend\Expressive\Application;

/** @var Application $app */
$app->get('/catalog', Action\CatalogLendingPageAction::class, 'catalog_category_lending');
$app->get('/catalog/{full_path:[\w\-\/]+}', Action\CatalogCategoryListAction::class, 'catalog_category_list');