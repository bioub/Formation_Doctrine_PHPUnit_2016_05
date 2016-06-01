<?php

namespace Application\Form;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ContactFormFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $contactForm = new ContactForm();

        $sm = $serviceLocator->getServiceLocator();
        $em = $sm->get('doctrine.entitymanager.orm_default');
        $contactForm->setObjectManager($em);

        $contactForm->init();

        return $contactForm;
    }
}