<?php


use Admin\Action;
use Zend\Expressive\Application;

/** @var Application $app */
$app->get('/admin', Action\AdminHomeAction::class, 'admin.home');

//Catalog
$app->get('/admin/catalog', Action\Catalog\AdminCatalogAction::class, 'admin.catalog');
$app->get('/admin/catalog/category', Action\Catalog\AdminCatalogCategoryAction::class, 'admin.catalog.category');
$app->get('/admin/catalog/category/{id:[\d]+}', Action\Catalog\AdminCatalogCategoryAction::class, 'admin.catalog.category.id');

