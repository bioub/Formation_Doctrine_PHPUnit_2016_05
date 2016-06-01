<?php

namespace ApplicationTest\Controller;

use Application\Entity\Contact;
use ApplicationTest\Service\FakeContactService;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class ContactControllerTest extends AbstractHttpControllerTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->setApplicationConfig(require 'config/application.config.php');
    }

    public function testListActionIsAccessible()
    {
        $this->dispatch('/');

        $this->assertModuleName('application');
        $this->assertControllerName('Application\Controller\Contact');
        $this->assertActionName('list');

        $this->assertResponseStatusCode(200);
    }

    public function testListActionContent()
    {
        $this->dispatch('/');

        $this->assertQueryCount('div.container > ul > li', 10);
    }

    public function testListActionContentWithFake()
    {
        $contactService = new FakeContactService([
            (new Contact())->setPrenom('Toto')->setNom('Titi'),
            (new Contact())->setPrenom('Tata')->setNom('Tutu'),
        ]);

        $sm = $this->getApplicationServiceLocator();
        $sm->setAllowOverride(true);
        $sm->setService('Application\Service\Contact', $contactService);

        $this->dispatch('/');

        $this->assertQueryCount('div.container > ul > li', 2);
    }

    public function testAddActionIsAccessible()
    {
        $this->dispatch('/add');

        $this->assertModuleName('application');
        $this->assertControllerName('Application\Controller\Contact');
        $this->assertActionName('add');

        $this->assertResponseStatusCode(200);
    }
}