<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2018, Alpha-Hydro
 *
 */

namespace Admin\Middleware;


use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\Response\RedirectResponse;

class AuthMiddleware implements MiddlewareInterface
{

    /**
     * @var AuthenticationService
     */
    private $authenticationService;

    /**
     * AuthMiddleware constructor.
     * @param AuthenticationService $authenticationService
     */
    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }


    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        if (!$this->authenticationService->hasIdentity()) {
            return new RedirectResponse('/login');
        }

        $identity = $this->authenticationService->getIdentity();
        return $delegate->process($request->withAttribute(self::class, $identity));
    }
}