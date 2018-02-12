<?php

use Zend\Expressive\Application;

/** @var Application $app */

$app->route('/login', User\Action\Login::class, ['GET', 'POST'], 'login');
$app->get('/logout', User\Action\Logout::class, 'logout');
$app->route('/admin/user/add', User\Action\UserAddPost::class, ['GET', 'POST'], 'admin.user.add');