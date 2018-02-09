<?php

/**
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Action\HomePageAction::class, 'home');
 * $app->post('/album', App\Action\AlbumCreateAction::class, 'album.create');
 * $app->put('/album/:id', App\Action\AlbumUpdateAction::class, 'album.put');
 * $app->patch('/album/:id', App\Action\AlbumUpdateAction::class, 'album.patch');
 * $app->delete('/album/:id', App\Action\AlbumDeleteAction::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Action\ContactAction::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', App\Action\ContactAction::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     App\Action\ContactAction::class,
 *     Zend\Expressive\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 *
 * @var Application $app
 */

use Zend\Expressive\Application;

$app->get('/admin', Admin\Action\AdminHomeAction::class, 'admin.home');

$app->get('/admin/catalog', Admin\Action\Catalog\AdminCatalogAction::class, 'admin.catalog');
$app->get('/admin/catalog/category', Admin\Action\Catalog\AdminCatalogCategoryAction::class, 'admin.catalog.category');
$app->get('/admin/catalog/category/{id:[\d]+}', Admin\Action\Catalog\AdminCatalogCategoryListAction::class, 'admin.catalog.category.id');
$app->route('/admin/catalog/category/add', [Admin\Action\Catalog\AdminCatalogCategoryAddForm::class, Admin\Action\Catalog\AdminCatalogCategoryAddPost::class], ['GET', 'POST'],'admin.catalog.category.add');
$app->route('/admin/catalog/category/update/{id:[\d]+}', [Admin\Action\Catalog\AdminCatalogCategoryUpdateForm::class, Admin\Action\Catalog\AdminCatalogCategoryUpdatePost::class], ['GET', 'POST'],'admin.catalog.category.update');
$app->get('/admin/catalog/category/disable/{id:[\d]+}', Admin\Action\Catalog\AdminCatalogCategoryDisable::class,'admin.catalog.category.disable');
$app->route('/admin/catalog/category/enable/{id:[\d]+}', Admin\Action\Catalog\AdminCatalogCategoryEnable::class, ['GET', 'POST'],'admin.catalog.category.enable');

