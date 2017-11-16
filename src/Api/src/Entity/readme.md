```php
<?php

namespace Api;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

class ConfigProvider
{
  
    public function __invoke()
    {
        return [
			/*....*/			
            'doctrine' => $this->getDoctrine(),
        ];
    }

    public function getDependencies()
    {
        /*....*/			

    }

    public function getTemplates()
    {
        /*....*/			

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

```

##### Создание сущностей из существующих таблиц базы данных

> В таблицах базы данных: 
>   * не должны быть поля "enum".
>   * присутствовать первичные ключи

**Генерируем объекты и экспортируем информацию об «аннотации» в ./src/Api/Entity** 

```cmd
vendor\bin\doctrine orm:convert-mapping --namespace="Api\Entity\\" --filter="\\Categories$" --force --from-database annotation src
```

> --filter - Regexp выражение, которое фильтрует создаваемые сущности (не имя таблицы)

**Генерируем объекты сущностей и добавляем setter/getter**

> К сожалению, Doctrine не поддерживает поддерживает стандарт PSR-4. Чтобы обойти эту проблему , мы должны переместить вручную из ./src/Api/Entity в ./src/Api/src/Entity.

```cmd
vendor\bin\doctrine orm:generate-entities src --generate-annotations=true --filter="\\Manufacture"
```