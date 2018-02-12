<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 12.02.2018
 * Time: 1:47
 */

namespace User\Factory;


use User\Service\AuthAdapter;
use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Session\SessionManager;

use Zend\Authentication\Storage\Session as SessionStorage;

class AuthenticationServiceFactory
{

    /**
     * @param ContainerInterface $container
     * @return AuthenticationService
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container)
    {

        $sessionManager = $container->get(SessionManager::class);
        $authStorage = new SessionStorage('Zend_Auth', 'session', $sessionManager);

        return new AuthenticationService(
            $authStorage,
            $container->get(AuthAdapter::class)
        );
    }
}