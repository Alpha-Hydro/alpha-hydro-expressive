<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 12.02.2018
 * Time: 3:07
 */

namespace Admin\Action;


use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class AuthAction implements ServerMiddlewareInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $templateRenderer;

    private $auth;

    public function __construct(AuthenticationService $auth, TemplateRendererInterface $templateRenderer)
    {
        $this->auth = $auth;
        $this->templateRenderer = $templateRenderer;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        if (! $this->auth->hasIdentity()) {
            return new HtmlResponse($this->templateRenderer->render('user::login'));
        }

        $identity = $this->auth->getIdentity();
        return $delegate->process($request->withAttribute(self::class, $identity));
    }
}