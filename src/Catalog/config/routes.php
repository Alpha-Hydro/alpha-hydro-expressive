<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

use Catalog\Action;

$app->get('/catalog', Action\CatalogCategoryListAction::class, 'catalog_category_list');