<?php

namespace Application\Controller;

use Zend\Mvc\Controller\ControllerManager;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ControllerAbstractFactory implements AbstractFactoryInterface
{
    protected $regexp = '/^Application\\\\Controller\\\\([^\\\\]+)$/';

    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        return (bool) preg_match($this->regexp, $requestedName);
    }

    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $matches = [];
        preg_match($this->regexp, $requestedName, $matches);

        $entity = $matches[1];
        $doctrineServiceName = 'Application\Service\\' . $entity;

        if ($serviceLocator instanceof ControllerManager) {
            $sm = $serviceLocator->getServiceLocator(); // ZF2
        }
        else {
            $sm = $serviceLocator; // ZF3
        }

        $doctrineService = $sm->get($doctrineServiceName);

        $controllerClass = $requestedName . 'Controller';

        return new $controllerClass($doctrineService);
    }
}