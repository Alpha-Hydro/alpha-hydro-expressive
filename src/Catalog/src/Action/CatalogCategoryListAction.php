<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Catalog\Action;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;


class CatalogCategoryListAction implements ServerMiddlewareInterface
{

    /**
     * @var Template\TemplateRendererInterface
     */
    private $templateRenderer;

    public function __construct(Template\TemplateRendererInterface $templateRenderer = null)
    {
        $this->templateRenderer = $templateRenderer;
    }


    /**
     * Process an incoming server request and return a response, optionally delegating
     * to the next middleware component to create the response.
     *
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     *
     * @return HtmlResponse
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        return new HtmlResponse($this->templateRenderer->render('catalog::listCategory'));
    }
}