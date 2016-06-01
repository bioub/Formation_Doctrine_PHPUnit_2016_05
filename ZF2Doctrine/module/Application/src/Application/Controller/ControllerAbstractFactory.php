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

        if ($serviceLocator instanceof ControllerManager) {
            $sm = $serviceLocator->getServiceLocator(); // ZF2
        }
        else {
            $sm = $serviceLocator; // ZF3
        }

        $doctrineServiceName = 'Application\Service\\' . $entity;
        $doctrineService = $sm->get($doctrineServiceName);

        $formServiceName = 'Application\Form\\' . $entity;
        $formElementManager = $sm->get('FormElementManager');
        $formService = $formElementManager->get($formServiceName);

        $controllerClass = $requestedName . 'Controller';

        return new $controllerClass($doctrineService, $formService);
    }
}