<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2018, Alpha-Hydro
 *
 */

namespace Utils\Action;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class WebhookAction implements ServerMiddlewareInterface
{

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $parseBody = $request->getParsedBody();
        $localRepo = realpath(__DIR__ . '/../../../../');

        if ($parseBody["payload"]){
            shell_exec("cd {$localRepo } && git fetch --all && git reset --hard origin/public");
        }

        return new JsonResponse(["OK"]);
    }
}