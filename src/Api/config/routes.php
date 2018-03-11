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

$app->get('/api/ping', Api\Action\PingAction::class);
$app->get('/api/categories', Api\Action\CatalogCategoriesAction::class);
$app->get('/api/categories/tree', Api\Action\CatalogGroupTree::class);
$app->get('/api/categories/set-path', Utils\Action\CategoriesSetPathAction::class);
$app->get('/api/products/set-path', Utils\Action\ProductsSetPathAction::class);

$app->post('/api/webhook', Utils\Action\WebhookAction::class);

