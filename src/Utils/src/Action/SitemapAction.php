<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2018, Alpha-Hydro
 *
 */

namespace Utils\Action;

use Api\Entity\Categories;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SimpleXMLElement;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\Response\XmlResponse;

class SitemapAction implements ServerMiddlewareInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * CatalogGroupTree constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     * @return ResponseInterface|XmlResponse
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $host = $request->getHeader('host');

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset/>');

        /**@var Categories[] $categories*/
        $categories = $this->entityManager->getRepository(Categories::class)
            ->findBy([
                'active' => 1,
                'deleted' => 0
            ]);
        foreach ($categories as $category){
            $xml->addChild('url')->addChild('loc', 'https://'.$host[0].'/'.$category->getFullPath());
        }

        return new XmlResponse($xml->asXML());
    }
}