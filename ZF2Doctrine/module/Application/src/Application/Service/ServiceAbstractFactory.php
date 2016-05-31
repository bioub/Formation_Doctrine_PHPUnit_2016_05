<?php

namespace Application\Service;

use Zend\Mvc\Controller\ControllerManager;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ServiceAbstractFactory implements AbstractFactoryInterface
{
    protected $regexp = '/^Application\\\\Service\\\\([^\\\\]+)$/';

    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        return (bool) preg_match($this->regexp, $requestedName);
    }

    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $matches = [];
        preg_match($this->regexp, $requestedName, $matches);

        $entity = $matches[1];

        $em = $serviceLocator->get('doctrine.entitymanager.orm_default');

        $serviceClass = $requestedName . 'Service';

        return new $serviceClass($em);
    }
}