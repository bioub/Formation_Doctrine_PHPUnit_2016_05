<?php

namespace ApplicationTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class IndexControllerTest extends AbstractHttpControllerTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->setApplicationConfig(require 'config/application.config.php');
    }

    public function testIndexActionIsAccessible()
    {
        $this->dispatch('/');

        $this->assertModuleName('application');
        $this->assertControllerName('Application\Controller\Index');
        $this->assertActionName('index');

        $this->assertResponseStatusCode(200);
    }
}