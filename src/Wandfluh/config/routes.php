<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

use Zend\Expressive\Application;

/** @var Application $app */
$app->get('/wandfluh', Wandfluh\Action\WandfluhLendingPageAction::class, 'wandfluh.lending');
$app->get('/wandfluh/setPath', Wandfluh\Action\WandfluhSetPathAction::class, 'wandfluh.setpath');