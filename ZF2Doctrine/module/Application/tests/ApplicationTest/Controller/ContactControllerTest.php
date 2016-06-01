<?php

namespace ApplicationTest\Controller;

use Application\Entity\Contact;
use Application\Form\ContactForm;
use Application\Service\ContactService;
use ApplicationTest\Service\FakeContactService;
use Zend\Http\Request;
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

    public function testListActionContentWithMockBuilder()
    {
        $contactService = $this->getMockBuilder(ContactService::class)
                               ->disableOriginalConstructor()
                               ->getMock();

        $contactService->expects($this->exactly(1))
                       ->method('findAll')
                       ->willReturn([
                           (new Contact())->setPrenom('Toto')->setNom('Titi'),
                           (new Contact())->setPrenom('Tata')->setNom('Tutu'),
                           (new Contact())->setPrenom('R')->setNom('B'),
                       ]);

        $sm = $this->getApplicationServiceLocator();
        $sm->setAllowOverride(true);
        $sm->setService('Application\Service\Contact', $contactService);

        $this->dispatch('/');

        $this->assertQueryCount('div.container > ul > li', 3);
    }

    public function testListActionContentWithMockProphecy()
    {
        $contactService = $this->prophesize(ContactService::class);

        $contactService->findAll()->willReturn([
            (new Contact())->setPrenom('Toto')->setNom('Titi'),
        ])->shouldBeCalledTimes(1);

        $sm = $this->getApplicationServiceLocator();
        $sm->setAllowOverride(true);
        $sm->setService('Application\Service\Contact', $contactService->reveal());

        $this->dispatch('/');

        $this->assertQueryCount('div.container > ul > li', 1);
    }

    public function testAddActionWithMock()
    {
        $contactService = $this->prophesize(ContactService::class);
        $contactService->insert(['prenom' => 'R', 'nom' => 'B'])->shouldBeCalledTimes(1);

        $sm = $this->getApplicationServiceLocator();
        $sm->setAllowOverride(true);
        $sm->setService('Application\Service\Contact', $contactService->reveal());

        $this->dispatch('/add', 'POST', ['prenom' => 'R', 'nom' => 'B']);

        echo $this->getApplication()->getResponse()->getContent();

        $this->assertResponseStatusCode(302);
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