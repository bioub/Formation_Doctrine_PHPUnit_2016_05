<?php

namespace ApplicationTest\Entity;


use Application\Entity\Contact;
use Doctrine\Common\Collections\ArrayCollection;

class ContactTest extends \PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        // avant tous les tests
    }

    public static function tearDownAfterClass()
    {
        // après tous les tests
    }

    protected function setUp()
    {
        $this->contact = new Contact();
    }

    protected function tearDown()
    {
        // après chaque test
    }

    public function testDefaultValues()
    {
        $this->assertNull($this->contact->getPrenom(), 'Le prénom ne contient pas la valeur null');
        $this->assertInstanceOf(ArrayCollection::class, $this->contact->getGroupes());
    }

    public function testGetSetPrenom()
    {
        $this->contact->setPrenom('Romain');

        $this->assertEquals($this->contact->getPrenom(), 'Romain');
    }
}