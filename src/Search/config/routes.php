<?php
use Zend\Expressive\Application;

/** @var Application $app */
$app->get('/search', Search\Action\SearchPageAction::class, 'search');
