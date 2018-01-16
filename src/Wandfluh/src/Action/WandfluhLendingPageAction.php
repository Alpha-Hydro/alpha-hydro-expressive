<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2018, Alpha-Hydro
 *
 */

namespace Wandfluh\Action;

use Api\Entity\Pages;
use Api\Entity\WfCategory;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class WandfluhLendingPageAction implements ServerMiddlewareInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $templateRenderer;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * PipelineLendingPageAction constructor.
     * @param TemplateRendererInterface $templateRenderer
     * @param EntityManager $entityManager
     */
    public function __construct(TemplateRendererInterface $templateRenderer, EntityManager $entityManager)
    {
        $this->templateRenderer = $templateRenderer;
        $this->entityManager = $entityManager;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $indexPage = $this->entityManager->getRepository(Pages::class)
            ->findByActiveModuleFromPath('wandfluh');

        if (!$indexPage)
            return new HtmlResponse($this->templateRenderer
                ->render('error::404'), 404);

        $categories = $this->entityManager->getRepository(WfCategory::class)
           ->findByActiveNoDeleted();


        $data = [
            'page' => $indexPage,
            'sidebarListItem' => $categories,
        ];


        return new HtmlResponse($this->templateRenderer
            ->render('wandfluh::lending', $data));
    }


}