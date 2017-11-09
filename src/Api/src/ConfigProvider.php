<?php

namespace Api;
use Doctrine\ORM\Mapping\Driver\SimplifiedYamlDriver;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

/**
 * The configuration provider for the Api module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     * @return array
     */
    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'doctrine' => $this->getDoctrine(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            'invokables' => [
            ],
            'factories'  => [
            ],
        ];
    }

    /**
     * Returns the templates configuration
     *
     * @return array
     */
    public function getTemplates()
    {
        return [
            'paths' => [
            ],
        ];
    }

    public function getDoctrine()
    {
        return [
            'driver' => [
                'orm_default' => [
                    'drivers' => [
                        'Api\Entity' => 'api_entity',
                    ],
                ],
                'api_entity' => [
                    'class' => AnnotationDriver::class,
                    'cache' => 'array',
                    'paths' => [
                        dirname(__DIR__) . '/src/Api/Entity' => './src/Api/Entity',
                    ],
                ],
            ],
        ];
    }
}
