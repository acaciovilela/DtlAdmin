<?php

namespace DtlAdmin\Controller\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use DtlAdmin\Controller\IndexController;

class IndexControllerFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        $controller = new IndexController();
        $controller->setEntityManager($container->get(\Doctrine\ORM\EntityManager::class));
        return $controller;
    }

}
